## How to Install

Copy the file throttle.php to application > libraries

## Dependencies

This library uses the Cache class built into Laravel

## How to Use

Create a new filter into application > filter.php

    'throttling' => function()
    {
		  if(Input::has('email'))
		  {
			   if(Throttle::is_over(Input::get('email')))
			   {
			    return redirect::to_signin();
		    }
	    }
	    return null;	
    },

whenever you need to throttle a route, add the filter in the before key

    'GET /login' => array('before' => 'throttling', function(){});
    
for increasing the throttle time (after a failed login attempt for example) call the method

    Throttle::increase($key);
    
to remove the throttle for a specific key, simply call

    Throttle::remove($key);

## Licence

Made by Luca Degasperi under the MIT Licence, do whatever you want with it.