<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Models\Shop;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopListController extends Controller
{
    public function index(Request $request)
    {
        try {
            $shops = Shop::query()
                ->when(auth()->user()->type === 'shop', fn($query) => $query->where('user_id', auth()->id()))
                ->withCount('today_print_jobs')->orderBy('created_at', 'desc')
                ->paginate(10);

            $shops->getCollection()->transform(function ($shop) {
                return [
                     ...$shop->toArray(),
                    'shop_uuid'              => $shop->uuid,
                    'created_at'             => $shop->created_at->toDateTimeString(),
                    'today_print_jobs_count' => $shop->today_print_jobs_count,
                    'qr_code_url'            => route('print', ['shop_uuid' => $shop->uuid]),
                ];
            });

            return inertia('Shops', [
                'shops' => $shops->toArray(),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to load shops. Please try again later. ERROR: ' . $e->getMessage()]);
        }
    }

    public function store(StoreShopRequest $request): RedirectResponse
    {
        $userId = $request->user()->id;

        Shop::query()->create([
            'uuid'                     => (string) Str::uuid(),
            'name'                     => $request->string('name')->toString(),
            'normal_print_price'       => $request->validated('normal_print_price'),
            'color_print_price'        => $request->validated('color_print_price'),
            'double_sided_print_price' => $request->validated('double_sided_print_price'),
            'user_id'                  => $userId,
            'created_by'               => $userId,
        ]);

        return to_route('shops')->with('success', 'Shop created successfully.');
    }

    public function update(StoreShopRequest $request, $id): RedirectResponse
    {
        $userId = $request->user()->id;
        $shop   = Shop::query()->findOrFail($id);
        $shop->update([
            'name'                     => $request->string('name')->toString(),
            'normal_print_price'       => $request->validated('normal_print_price'),
            'color_print_price'        => $request->validated('color_print_price'),
            'double_sided_print_price' => $request->validated('double_sided_print_price'),
            'updated_by'               => $userId,
        ]);

        return to_route('shops')->with('success', 'Shop updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        try {

            $shop = Shop::query()->findOrFail($id);

            if (! $shop) {
                return redirect()->back()->withErrors(['error' => 'Shop not found.']);
            }

            $doesPrintJobsExists = $shop->print_jobs()->exists();

            if ($doesPrintJobsExists) {
                return redirect()->back()->withErrors(['error' => 'Cannot delete shop with existing print jobs.']);
            }

            $shop->delete();

            return to_route('shops')->with('success', 'Shop deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete shop. Please try again later. ERROR: ' . $e->getMessage()]);
        }
    }
}