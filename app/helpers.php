<?php 

use Carbon\Carbon;

if(!function_exists('formatDate'))
{
    /**
     * format date
     */
    function formatDate($date, $opt="fulldate")
    {
        return match($opt) {
            default => '',
            'dateInput' => date('Y-m-d'),
            'fulldate' => date('F d,Y', strtotime($date)),
            'dateTime' => date('M d,Y h:iA', strtotime($date)),
            'dateTimeWithSeconds' => date('Y-m-d h:i:s', strtotime($date)),
            'dateTimeLocal' => date('Y-m-d\TH:i', strtotime($date)),
            'time' => date('h:iA', strtotime($date)),
        };
    }

}

if(!function_exists('getAge'))
{
    /**
     * get the age by birth date
     */
     function getAge($birth_date)
    {
        return Carbon::parse($birth_date)->age;
    }
}


if(!function_exists('getPetAge'))
{
    /**
     * get the age of the pet by birth date
     */
     function getPetAge($birth_date)
    {
        $birthDate = Carbon::parse($birth_date);
        $currentDate = Carbon::now();
        $ageYears = $birthDate->diffInYears($currentDate);

        if ($ageYears < 1) {
            $ageMonths = $birthDate->diffInMonths($currentDate);
            if ($ageMonths < 1) {
                return 'Less than 1 month old';
            }
            return $ageMonths . ' months';
        }

        return $ageYears . ' years';
    }
}

if(!function_exists('handleBookingStatus'))
{
     /**
     * check if the status is pending | approved | canceled
     */
    function handleBookingStatus($status)
    {
        return match($status) {
            0 => "<span class='badge badge-primary'>Pending <i class='fas fa-spinner ml-1'></i></span>",
            1 => "<span class='badge badge-success'>Approved <i class='fas fa-check-circle ml-1'></i></span>",
            2 => "<span class='badge badge-danger'>Canceled <i class='fas fa-times-circle ml-1'></i></span>",
        };
    }

}

if(!function_exists('handleNullAvatar'))
{
    /**
     * handle Null Avatar Image
     */
    function handleNullAvatar($img)
    {
        return $img ?? '/img/noimg.svg';
    }
}


if(!function_exists('handleNullAvatarForPet'))
{
    /**
     * handle Null Avatar Image
     */
    function handleNullAvatarForPet($img)
    {
        return $img ?? '/img/paw.png';
    }
}


if(!function_exists('handleNullImage'))
{
    /**
     * handle Null Image
     */
    function handleNullImage($img)
    {
        return $img ?? '/img/noimg.png';
    }
}


if(!function_exists('isLikedByAuthUser'))
{
     /**
     * check if this model is liked by authenticated user
     */
    function isLikedByAuthUser($auth_user, $likers) 
    {
        $post_likers = [];// users who likes the post

        foreach($likers as $liker) {
        $post_likers[] = $liker->user_id; // get user id 
        }

        return  (in_array($auth_user, $post_likers)) ? true : false; // check if the user has already liked the post
    }
}



if(!function_exists('isOnline'))
{
     /**
     * check if the payment method status is approved
     */
    function isOnline($bool)
    {
        return $bool  ? "<span class='badge badge-success'>Online <i class='fas fa-check-circle ml-1'></i></span>" : "<span class='badge badge-danger'>Offline</span>";
    }

}

if(!function_exists('isVerified'))
{
     /**
     * check if the user email is verified
     */
    function isVerified($bool)
    {
        return $bool  ? "<span class='badge badge-success'>Verified <i class='fas fa-check-circle ml-1'></i></span>" : "<span class='badge badge-danger'>Unverified</span>";
    }
}


if(!function_exists('isActivated'))
{
     /**
     * check if the status is approved
     */
    function isActivated($bool)
    {
        return $bool == 0 
        ? "<span class='badge bg-danger text-white'>Deactivated <i class='fas fa-times-circle ml-1'></i></span>"
        : "<span class='badge bg-success text-white'>Activated <i class='fas fa-check-circle ml-1'></i></span>";
    }

}


if(!function_exists('isApproved'))
{
     /**
     * check if the status is approved
     */
    function isApproved($bool)
    {
        if ($bool == 0) {
            return "<span class='badge bg-info p-2'>Pending <i class='fas fa-spinner ms-2'></i></span>";
        } else if($bool == 1) {
            return "<span class='badge bg-success p-2'>Approved</span>";
        } else {
            return "<span class='badge bg-danger p-2'>Declined</span>";
        }
    }
}

if(!function_exists('isPaymentMethodOnline'))
{
     /**
     * check if the payment status is online || offline
     */
    
    function isPaymentMethodOnline($bool)
    {
        return $bool ? "<span class='badge badge-success'>Online</span>" : "<span class='badge badge-danger'>Offline</span>";
    }
}

if(!function_exists('textTruncate'))
{
    /**
     * truncate text
     */
    function textTruncate($string, $length = 150)
    {
       return \Illuminate\Support\Str::limit($string, $length, $end='...');
    }

}