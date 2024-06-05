<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;




Broadcast::channel('test-channel.{tenat}', function ($user,$tenant){
    return Auth::check() && Session::get('tenant') ==$tenant;
});
