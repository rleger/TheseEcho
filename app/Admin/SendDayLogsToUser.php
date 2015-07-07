<?php

namespace These\Admin;

use App;
use These\Notifications\SendAdminMessageToUser;
use These\Users\UserRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class SendDayLogsToUser.
 */
class SendDayLogsToUser
{
    /**
     * @var
     */
    protected $day;

    /**
     * @var array
     */
    protected $users;

    /**
     * @var array
     */
    protected $usersRole;

    /**
     * @var
     */
    protected $userRepository;
    /**
     * @var null|string
     */
    protected $log;

    /**
     * @var array
     */
    protected $mailingList;

    /**
     * Constructor.
     *
     * @param       $day
     * @param array $users
     * @param array $usersRole
     */
    public function __construct($day, $users = [], $usersRole = [])
    {
        $this->userRepository = App::make(UserRepository::class);

        $dateResolver = App::make(DateResolver::class);

        $this->users = $users;

        $this->usersRole = $usersRole;

        $this->day = $dateResolver->get($day);

        $this->log = $this->findLogs();

        $this->mailingList = $this->getUsersMailingList();
    }

    /**
     * Find the log file.
     *
     * @return null|string
     */
    protected function findLogs()
    {
        $logFileName = $this->resolveLogFileName();

        if (file_exists($logFileName)) {
            return $logFileName;
        }

        return;
    }

    /**
     * Get final user mailing list.
     *
     * @return array
     */
    protected function getUsersMailingList()
    {
        return array_merge($this->getUsersEmails(), $this->getUsersRoleEmails());
    }

    /**
     * Get users with matching username.
     *
     * @return array
     */
    protected function getUsersEmails()
    {
        return array_filter(array_map(function ($user) {
            $foundUser = $this->userRepository->findByUsername($user);

            if (count($foundUser) && $foundUser->email) {
                return $foundUser->email;
            }
        }, $this->users));
    }

    /**
     * Get Users with matching user role.
     *
     * @return array
     */
    protected function getUsersRoleEmails()
    {
        $email = [];

        foreach ($this->usersRole as $userRole) {
            $foundUser = $this->userRepository->findByUserRole($userRole);

            return array_filter($foundUser->lists('email')->all());
        }

        return $email;
    }

    /**
     * Send the logs.
     *
     * @return string
     */
    public function send()
    {
        $response = App::make(ResponseFactory::class);

        $sendToUser = App::make(SendAdminMessageToUser::class);

        if (!$this->log) {
            return $response->make('Nothing to log', $status = 200);
        }

        // Not sending the Log as attachement as it might be too big!!
        $sent = $sendToUser->send('emails.log', [
            'logFileName' => pathinfo($this->log, PATHINFO_BASENAME),
            ], $this->mailingList);

        if (!$sent) {
            return $response->make('Nothing was sent, there might be some kind of error ?', $status = 400);
        }

        return $response->make('A message was sent !', $status = 200);
    }

    /**
     * Resolve Log file name.
     *
     * @return string
     */
    protected function resolveLogFileName()
    {
        return storage_path()."/logs/laravel-$this->day.log";
    }
}
