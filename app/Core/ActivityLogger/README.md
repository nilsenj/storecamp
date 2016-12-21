L
## Installation

```php
'providers' => [
    // ...
    App\Core\Auditing\AuditingServiceProvider::class,
],
```

> Note: This provider is important for the publication of configuration files.

Use the following command to publish configuration settings:

```
php artisan vendor:publish --provider="App\Core\Auditing\AuditingServiceProvider"
```
Finally, execute the migration to create the ```logs``` table in your database. This table is used to save audit logs.

```
php artisan migrate
```


## Docs
* [Implementation](#implementation)
* [Configuration](#configuration)
* [Getting the Logs](#getting)
* [Customizing log message](#customizing)
* [Examples](#examples)
* [Contributing](#contributing)
* [Having problems?](#faq)
* [license](#license)

<a name="implementation"></a>
## Implementation

### Implementation using ```Trait```

To register the change log, use the trait `OwnerIt\Auditing\AuditingTrait` in the model you want to audit

```php
// app/Team.php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Core\Auditing\AuditingTrait;

class Team extends Model 
{
    use AuditingTrait;
    //...
}

```

### Base implementation Legacy Class

It is also possible to have your model extend the `OwnerIt\Auditing\Auditing` class to enable auditing. Example:

```php
// app/Team.php
namespace App;

use App\Core\Auditing\Auditing;

class Team extends Auditing 
{
    //...    
}
```

<a name="configuration"></a>
### Configuration

The Auditing behavior settings are carried out with the declaration of attributes in the model. See the examples below:

* Turn off logging after a number "X": `$historyLimit = 500`
* Disable / enable logging (Audit): `$auditEnabled = false`
* Turn off logging for specific fields: `$dontKeepLogOf = ['field1', 'field2']`


```php
// app/Team.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model 
{
    use App\Core\Auditing\AuditingTrait;
    // Disables the log record in this model.
    protected $auditEnabled  = false;
    // Disables the log record after 500 records.
    protected $historyLimit = 500; 
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];
}
```

<a name="getting"></a>
## Getting the Logs

```php
// app/Http/Controller/MyAppController.php
namespace App\Http\Controllers;

use App\Team;

class MyAppController extends BaseController 
{
    public function index()
    {
        $team = Team::find(1); // Get team
        $team->logs; // Get all logs
        $team->logs->first(); // Get first log
        $team->logs->last();  // Get last log
        $team->logs->find(2); // Selects log
    }
    //...
}
```
Getting logs with user responsible for the change.
```php
use App\Core\Auditing\Log;

$logs = Log::with(['user'])->get();

```
or
```php
use App\Team;

$logs = Team::logs->with(['user'])->get();

```

> Note: Remember to properly define the user model in the file ``` config/auditing.php ```
>```php
> ...
> 'model' => App\User::class,
> ... 
>```

<a name="customizing"></a>
## Customizing log message

You it can set custom messages for presentation of logs. These messages can be set for both the model as for specific fields.The dynamic part of the message can be done by targeted fields per dot segmented as`{object.value.value} or {object.value|Default value} or {object.value||callbackMethod}`. 

> Note: This implementation is optional, you can make these customizations where desired.

Set messages to the model
```php
// app/Team.php
namespace App;

use App\Core\Auditing\Auditing;

class Team extends Auditing 
{
    //...
    public static $logCustomMessage = '{user.name|Anonymous} {type} a team {elapsed_time}'; // with default value
    public static $logCustomFields = [
        'name'  => 'The name was defined as {new.name||getNewName}', // with callback method
        'owner' => [
            'updated' => '{new.owner} owns the team',
            'created' => '{new.owner|No one} was defined as owner'
        ],
    ];
    
    public function getNewName($log)
    {
        return $log->new['name'];
    }
    //...
}
```
Getting change logs 
```php
// app/Http/Controllers/MyAppController.php 
//...
public function auditing()
{
    $logs = Team::find(1)->logs; // Get logs of team
    return view('auditing', compact('logs'));
}
//...
    
```
Featuring log records:
```
    // resources/views/my-app/auditing.blade.php
    ...
    <ol>
        @forelse ($logs as $log)
            <li>
                {{ $log->customMessage }}
                <ul>
                    @forelse ($log->customFields as $custom)
                        <li>{{ $custom }}</li>
                    @empty
                        <li>No details</li>
                    @endforelse
                </ul>
            </li>
        @empty
            <p>No logs</p>
        @endforelse
    </ol>
    ...
    
```
Result:
<ol>
  <li>Antério Vieira created a team 1 day ago   
    <ul>
      <li>The name was defined as gestao</li>
      <li>No one was defined as owner</li>
    </ul>
  </li>
  <li>Rafael França deleted a team 2 day ago   
    <ul>
      <li>No details</li>
    </ul>
  </li>  
  <li>...</li>
</ol>

<a name="examples"></a>
