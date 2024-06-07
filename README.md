# Simple, reusable and easy to use actions inside your Laravel app

![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/tobikaleigh/laravel-actions/run-tests.yml?label=Tests)

This is a simple package designed to add reusable actions to your Laravel application. It is inspired by the /actions directory from Laravel Jetstream. Really simple and easy to use actions designed for your Laravel Models.

Here's a demo of how you can use it:

```php
Class Order extends Model {

    protected static $actions = [
        'cancel'        => \App\Actions\Order\DeleteAction::class,
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

```php
use Tobikaleigh\Actions\Action;

// Models
use App\Models\Order;

class DeleteAction extends Action {

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

```php
use App\Models\Order;

$order = Order::find(100);
$order->delete();
```

# Even dispatch to a queue for longrunning tasks

You can dispatch any action to Laravels queue system.

```php
use Tobikaleigh\Actions\QueueableAction;

// Models
use App\Models\Order;

class DeleteAction extends QueueableAction {

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
