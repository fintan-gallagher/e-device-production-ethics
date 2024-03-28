<?


namespace App\View\Components;

use Illuminate\View\Component;

class DeviceCheckbox extends Component
{
    public $device;
    public $checked;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Device  $device
     * @param  bool  $checked
     * @return void
     */
    public function __construct($device, $checked = false)
    {
        $this->device = $device;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.device-checkbox');
    }
}
