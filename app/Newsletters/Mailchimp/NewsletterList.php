<?php

namespace These\Newsletters\Mailchimp;

use Illuminate\Config\Repository as Config;
use Mailchimp;
use These\Newsletters\NewsletterList as NewsletterListInterface;
use These\Newsletters\Exceptions\InvalidNewsletterList;

/**
 * Class NewsletterList.
 */
class NewsletterList implements NewsletterListInterface
{
    /**
     * List names.
     *
     * @var array
     */
    protected $lists = [];

    /**
     * @var Mailchimp
     */
    protected $mailchimp;

    /**
     * Mailchimp class.
     *
     * @param Mailchimp $mailchimp
     */
    public function __construct(Mailchimp $mailchimp, Config $config)
    {
        $this->mailchimp = $mailchimp;

        $this->lists = $config->get('These.mailchimp.lists');
    }

    /**
     * Subscribe to a newsletter.
     *
     * @param        $listName
     * @param        $email
     * @param null   $merge_vars
     * @param string $email_type
     * @param bool   $double_optin
     * @param bool   $update_existing
     * @param bool   $replace_interests
     * @param bool   $send_welcome
     *
     * @internal param $newsletter
     *
     * @return mixed
     */
    public function subscribeTo($listName, $email, $merge_vars = null, $email_type = 'html', $double_optin = false, $update_existing = false, $replace_interests = true, $send_welcome = false)
    {
        return $this->mailchimp->lists->subscribe(
            $this->lists[$listName],
            compact('email'),
            $merge_vars,
            $email_type,
            $double_optin,
            $update_existing,
            $replace_interests,
            $send_welcome
        );
    }

    /**
     * Batch subscribe.
     *
     * @param      $listName
     * @param      $batch
     * @param bool $double_optin
     * @param bool $update_existing
     * @param bool $replace_interests
     *
     * @return \associative_array
     */
    public function batchSubscribeTo($listName, $batch, $double_optin = false, $update_existing = false, $replace_interests = true)
    {
        return $this->mailchimp->lists->batchSubscribe(
            $this->lists[$listName],
            $batch,
            $double_optin,
            $update_existing,
            $replace_interests
        );
    }

    /**
     * Unsubscribe from a newsletter.
     *
     * @param $listName
     * @param $email
     *
     * @internal param $newsletter
     *
     * @return mixed
     */
    public function unSubscribeFrom($listName, $email)
    {
        return $this->mailchimp->lists->unsubscribe(
            $this->lists[$listName],
            compact('email'),
            false, // delete member
            false, // goodbye email
            false // unsubscribe email
        );
    }

    /**
     * Checks that the list is valid.
     *
     * @param $list
     *
     * @return bool
     *
     * @throws InvalidNewsletterList
     */
    public function checkListExists($list)
    {
        if (array_key_exists($list, $this->lists)) {
            return true;
        }

        throw new InvalidNewsletterList("La liste [$list] n'existe pas !");
    }
}
