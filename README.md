# Simple, reusable and easy to use actions inside your Laravel app

![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/tobikaleigh/laravel-actions/run-tests.yml?label=Tests)

This is a simple package designed to add reusable actions to your Laravel application. It is inspired by the /actions directory from Laravel Jetstream. Really simple and easy to use actions designed for your Laravel Models.

Here's a demo of how you can use it:

```php
namespace App\Models;

// Traits
use Tobikaleigh\Actions\Traits\HasActions;

Class Order extends Model {
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

```php
use App\Models\Order;

$order = Order::find(100);

// Using your shorthand.
$order->cancel();

// Or normally in any case.
$order->runAction('cancel');
```

# Even dispatch to a queue for longrunning tasks

You can dispatch any action to the [Laravel Queue](https://laravel.com/docs/queues). Extend the `QueueableAction`.

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
## Support

Feel free to open an issue if you have any questions.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
