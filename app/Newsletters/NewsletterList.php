<?php

namespace These\Newsletters;

/**
 * Interface NewsletterList.
 */
interface NewsletterList
{
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
    public function subscribeTo($listName, $email, $merge_vars = null, $email_type = 'html', $double_optin = false, $update_existing = false, $replace_interests = true, $send_welcome = false);

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
    public function batchSubscribeTo($listName, $batch, $double_optin = false, $update_existing = false, $replace_interests = true);

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
    public function unSubscribeFrom($listName, $email);

    /**
     * Checks that the list is valid.
     *
     * @param $list
     *
     * @return bool
     *
     * @throws InvalidNewsletterList
     */
    public function checkListExists($list);
}
