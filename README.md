# Simple, reusable and easy to use actions inside your Laravel app

![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/tobikaleigh/laravel-actions/run-tests.yml?label=Tests)

This is a simple package designed to add reusable actions to your Laravel application. It is inspired by the /actions directory from Laravel Jetstream. Really simple and easy to use actions designed for your Laravel Models.

Here's a demo of how you can use it with a Model:

```php
namespace App\Models;

// Traits
use Tobikaleigh\Actions\Traits\HasActions;

class Order extends Model {
    
    use HasActions;

    protected static $actions = [
        'cancel'        => \App\Actions\Order\CancelAction::class,
    ]

    /**
     * Optional: Add a nice shorthand.
     */
    public function cancel(): bool
    {
        $this->runAction('cancel');
    }
}
```

Create the action. Usually you would put this inside the /actions directory.

```php
namespace App\Actions\Order;

use Tobikaleigh\Actions\Action;

// Models
use App\Models\Order;

class CancelAction extends Action {

    public function __construct(public Order $post){

    }

    public function handle(): mixed
    {
        // Do a bunch of stuff here..

        // ...

        $this->order->delete();
    }
}
```
Now simply run the action using ``runAction()``.

```php
use App\Models\Order;

$order = Order::find(100);

// Using your shorthand.
$order->cancel();

// Or normally in any case.
$order->runAction('cancel');
```

# Dispatch to a queue for long-running tasks

You can dispatch any action to the [Laravel Queue](https://laravel.com/docs/queues). Extend the action using `QueueableAction`.

```php
namespace App\Actions\Order;

use Tobikaleigh\Actions\QueueableAction;

// Models
use App\Models\Order;

class CancelAction extends QueueableAction {

    public function __construct(public Order $post){

    }

    public function handle(): bool
    {
        // Do a bunch of stuff here..

        // ...

        $this->order->delete();
    }
}
```

Then queue it when needed.

```php
use App\Models\Order;

$order = Order::find(100);

// Send it to the queue..
$order->queueAction('cancel');

// Or run it synchronously, if you want..
$order->runAction('cancel');
```

If you wish to, you can customize the queue the action should be dispatched to.

```php
namespace App\Models;

class Order extends Model {

    use HasActions;

    protected static $actions = [
        'cancel'        => \App\Actions\Order\CancelAction::class,
    ]

    /**
     * Get the queues for the actions.
     */
    protected function actionViaQueues(): array
    {
        return [
            // 'action' => 'queue'
            'cancel'    => 'on-demand'
        ];
    }
}
```

## Support

Feel free to open an issue if you have any questions.

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
