<?php

function getLoggedInUser()
{
    return auth()->user();
}

function getImagePath($folder_name, $image_name)
{
    return asset('images/'.$folder_name.'/'.$image_name);
}
