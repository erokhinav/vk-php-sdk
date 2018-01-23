<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;
use VK\Actions\Enums\AccountLookupContactsService;
use VK\Actions\Enums\AccountSaveProfileInfoSex;
use VK\Actions\Enums\AccountSaveProfileInfoRelation;
use VK\Actions\Enums\AccountSaveProfileInfoBdateVisibility;

class Account {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns non-null values of user counters.
     * 
     * @param $access_token string
     * @param $params array
     *      - array filter: Counters to be returned.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getCounters($access_token, $params = array()) {
        return $this->client->request('account.getCounters', $access_token, $params);
    }

    /**
     * Sets an application screen name (up to 17 characters), that is shown to the user in the left menu.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     *      - string name: Application screen name.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setNameInMenu($access_token, $params = array()) {
        return $this->client->request('account.setNameInMenu', $access_token, $params);
    }

    /**
     * Marks the current user as online for 15 minutes.
     * 
     * @param $access_token string
     * @param $params array
     *      - boolean voip: '1' if videocalls are available for current device.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setOnline($access_token, $params = array()) {
        return $this->client->request('account.setOnline', $access_token, $params);
    }

    /**
     * Marks a current user as offline.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setOffline($access_token, $params = array()) {
        return $this->client->request('account.setOffline', $access_token, $params);
    }

    /**
     * Allows to search the VK users using phone numbers, e-mail addresses and user IDs on other services.
     * 
     * @param $access_token string
     * @param $params array
     *      - array contacts: List of contacts separated with commas
     *      - AccountLookupContactsService service: String identifier of a service which contacts are used for
     *        searching. Possible values: , * email, * phone, * twitter, * facebook, * odnoklassniki, * instagram, *
     *        google
     *        @see AccountLookupContactsService
     *      - string mycontact: Contact of a current user on a specified service
     *      - boolean return_all: '1' – also return contacts found using this service before, '0' – return only
     *        contacts found using 'contacts' field.
     *      - array fields: Profile fields to return. Possible values: 'nickname, domain, sex, bdate, city,
     *        country, timezone, photo_50, photo_100, photo_200_orig, has_mobile, contacts, education, online, relation,
     *        last_seen, status, can_write_private_message, can_see_all_posts, can_post, universities'.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function lookupContacts($access_token, $params = array()) {
        return $this->client->request('account.lookupContacts', $access_token, $params);
    }

    /**
     * Subscribes an iOS/Android/Windows Phone-based device to receive push notifications
     * 
     * @param $access_token string
     * @param $params array
     *      - string token: Device token used to send notifications. (for mpns, the token shall be URL for sending
     *        of notifications)
     *      - string device_model: String name of device model.
     *      - integer device_year: Device year.
     *      - string device_id: Unique device ID.
     *      - string system_version: String version of device operating system.
     *      - string settings: Push settings in a [vk.com/dev/push_settings|special format].
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function registerDevice($access_token, $params = array()) {
        return $this->client->request('account.registerDevice', $access_token, $params);
    }

    /**
     * Unsubscribes a device from push notifications.
     * 
     * @param $access_token string
     * @param $params array
     *      - string device_id: Unique device ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function unregisterDevice($access_token, $params = array()) {
        return $this->client->request('account.unregisterDevice', $access_token, $params);
    }

    /**
     * Mutes push notifications for the set period of time.
     * 
     * @param $access_token string
     * @param $params array
     *      - string device_id: Unique device ID.
     *      - integer time: Time in seconds for what notifications should be disabled. '-1' to disable forever.
     *      - integer peer_id: Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat
     *        ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     *      - integer sound: '1' — to enable sound in this dialog, '0' — to disable sound. Only if 'peer_id'
     *        contains user or community ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setSilenceMode($access_token, $params = array()) {
        return $this->client->request('account.setSilenceMode', $access_token, $params);
    }

    /**
     * Gets settings of push notifications.
     * 
     * @param $access_token string
     * @param $params array
     *      - string device_id: Unique device ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getPushSettings($access_token, $params = array()) {
        return $this->client->request('account.getPushSettings', $access_token, $params);
    }

    /**
     * Change push settings.
     * 
     * @param $access_token string
     * @param $params array
     *      - string device_id: Unique device ID.
     *      - string settings: Push settings in a [vk.com/dev/push_settings|special format].
     *      - string key: Notification key.
     *      - array value: New value for the key in a [vk.com/dev/push_settings|special format].
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setPushSettings($access_token, $params = array()) {
        return $this->client->request('account.setPushSettings', $access_token, $params);
    }

    /**
     * Gets settings of the user in this application.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID whose settings information shall be got. By default: current user.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getAppPermissions($access_token, $params = array()) {
        return $this->client->request('account.getAppPermissions', $access_token, $params);
    }

    /**
     * Returns a list of active ads (offers) which executed by the user will bring him/her respective number of votes
     * to his balance in the application.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer count: Number of results to return.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getActiveOffers($access_token, $params = array()) {
        return $this->client->request('account.getActiveOffers', $access_token, $params);
    }

    /**
     * Adds user to the banlist.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function banUser($access_token, $params = array()) {
        return $this->client->request('account.banUser', $access_token, $params);
    }

    /**
     * Deletes user from the blacklist.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function unbanUser($access_token, $params = array()) {
        return $this->client->request('account.unbanUser', $access_token, $params);
    }

    /**
     * Returns a user's blacklist.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of results.
     *      - integer count: Number of results to return.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getBanned($access_token, $params = array()) {
        return $this->client->request('account.getBanned', $access_token, $params);
    }

    /**
     * Returns current account info.
     * 
     * @param $access_token string
     * @param $params array
     *      - array fields: Fields to return. Possible values: *'country' — user country,, *'https_required' —
     *        is "HTTPS only" option enabled,, *'own_posts_default' — is "Show my posts only" option is enabled,,
     *        *'no_wall_replies' — are wall replies disabled or not,, *'intro' — is intro passed by user or not,,
     *        *'lang' — user language. By default: all.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getInfo($access_token, $params = array()) {
        return $this->client->request('account.getInfo', $access_token, $params);
    }

    /**
     * Allows to edit the current account info.
     * 
     * @param $access_token string
     * @param $params array
     *      - string name: Setting name.
     *      - string value: Setting value.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setInfo($access_token, $params = array()) {
        return $this->client->request('account.setInfo', $access_token, $params);
    }

    /**
     * Changes a user password after access is successfully restored with the [vk.com/dev/auth.restore|auth.restore]
     * method.
     * 
     * @param $access_token string
     * @param $params array
     *      - string restore_sid: Session id received after the [vk.com/dev/auth.restore|auth.restore] method is
     *        executed. (If the password is changed right after the access was restored)
     *      - string change_password_hash: Hash received after a successful OAuth authorization with a code got by
     *        SMS. (If the password is changed right after the access was restored)
     *      - string old_password: Current user password.
     *      - string new_password: New password that will be set as a current
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function changePassword($access_token, $params = array()) {
        return $this->client->request('account.changePassword', $access_token, $params);
    }

    /**
     * Returns the current account info.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getProfileInfo($access_token, $params = array()) {
        return $this->client->request('account.getProfileInfo', $access_token, $params);
    }

    /**
     * Edits current profile info.
     * 
     * @param $access_token string
     * @param $params array
     *      - string first_name: User first name.
     *      - string last_name: User last name.
     *      - string maiden_name: User maiden name (female only)
     *      - string screen_name: User screen name.
     *      - integer cancel_request_id: ID of the name change request to be canceled. If this parameter is sent,
     *        all the others are ignored.
     *      - AccountSaveProfileInfoSex sex: User sex. Possible values: , * '1' – female,, * '2' – male.
     *        @see AccountSaveProfileInfoSex
     *      - AccountSaveProfileInfoRelation relation: User relationship status. Possible values: , * '1' –
     *        single,, * '2' – in a relationship,, * '3' – engaged,, * '4' – married,, * '5' – it's complicated,,
     *        * '6' – actively searching,, * '7' – in love,, * '0' – not specified.
     *        @see AccountSaveProfileInfoRelation
     *      - integer relation_partner_id: ID of the relationship partner.
     *      - string bdate: User birth date, format: DD.MM.YYYY.
     *      - AccountSaveProfileInfoBdateVisibility bdate_visibility: Birth date visibility. Returned values: , *
     *        '1' – show birth date,, * '2' – show only month and day,, * '0' – hide birth date.
     *        @see AccountSaveProfileInfoBdateVisibility
     *      - string home_town: User home town.
     *      - integer country_id: User country.
     *      - integer city_id: User city.
     *      - string status: Status text.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function saveProfileInfo($access_token, $params = array()) {
        return $this->client->request('account.saveProfileInfo', $access_token, $params);
    }
}