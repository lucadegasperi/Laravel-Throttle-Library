## How to Install

Run the following command on the terminal

    $ php artisan bundle:install throttle

Edit application/bundles.php and add the following lines

    return array(
    'throttle' => array(
	    'auto' => true
	    )
    )

## Dependencies

This library uses the Cache class built into Laravel

## How to Use

Create a new filter into application > routes.php

    Route::filter('throttle', function()
    {
		  if(Input::has('email'))
		  {
			   if(Throttle::is_over(Input::get('email')))
			   {
				return Redirect::to('/');
		    	}
	    }
	    return null;	
    });

Replace Input::has('email') with whatever field your login form has to recognize the user.

whenever you need to throttle a route, add the filter in the before key

    'GET /login' => array('before' => 'throttle', function(){});
    
for increasing the throttle time (after a failed login attempt for example) call the method

    Throttle::increase($key);
    
to remove the throttle for a specific key, simply call

    Throttle::remove($key);

## Licence

Made by Luca Degasperi under the MIT Licence, do whatever you want with it.