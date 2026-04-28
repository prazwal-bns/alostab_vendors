<?php

namespace Gloudemans\Shoppingcart\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Cart
{
    private const SESSION_KEY = 'legacy_shopping_cart';

    public static function add(array $data): object
    {
        $cart = self::rawCart();

        $id = (string) ($data['id'] ?? '');
        $name = (string) ($data['name'] ?? '');
        $qty = max(1, (int) ($data['qty'] ?? 1));
        $price = (float) ($data['price'] ?? 0);
        $weight = (float) ($data['weight'] ?? 0);
        $options = (array) ($data['options'] ?? []);

        $rowId = self::rowId($id, $options);

        if (isset($cart[$rowId])) {
            $cart[$rowId]['qty'] += $qty;
        } else {
            $cart[$rowId] = [
                'rowId' => $rowId,
                'id' => $id,
                'name' => $name,
                'qty' => $qty,
                'price' => $price,
                'weight' => $weight,
                'options' => (object) $options,
            ];
        }

        self::storeCart($cart);

        return self::toItem($cart[$rowId]);
    }

    public static function content(): Collection
    {
        return collect(self::rawCart())->map(fn (array $item) => self::toItem($item));
    }

    public static function count(): int
    {
        return (int) collect(self::rawCart())->sum('qty');
    }

    public static function total(): string
    {
        $total = collect(self::rawCart())->reduce(
            fn (float $carry, array $item) => $carry + ((float) $item['price'] * (int) $item['qty']),
            0.0
        );

        return number_format($total, 2, '.', '');
    }

    public static function remove(string $rowId): void
    {
        $cart = self::rawCart();
        unset($cart[$rowId]);
        self::storeCart($cart);
    }

    public static function get(string $rowId): ?object
    {
        $item = self::rawCart()[$rowId] ?? null;

        return $item ? self::toItem($item) : null;
    }

    public static function update(string $rowId, int $qty): ?object
    {
        $cart = self::rawCart();

        if (!isset($cart[$rowId])) {
            return null;
        }

        if ($qty <= 0) {
            unset($cart[$rowId]);
            self::storeCart($cart);
            return null;
        }

        $cart[$rowId]['qty'] = $qty;
        self::storeCart($cart);

        return self::toItem($cart[$rowId]);
    }

    public static function destroy(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    private static function rowId(string $id, array $options): string
    {
        $payload = $id . '|' . json_encode($options);
        return (string) Str::of(md5($payload));
    }

    private static function rawCart(): array
    {
        return (array) Session::get(self::SESSION_KEY, []);
    }

    private static function storeCart(array $cart): void
    {
        Session::put(self::SESSION_KEY, $cart);
    }

    private static function toItem(array $item): object
    {
        $item['subtotal'] = number_format((float) $item['price'] * (int) $item['qty'], 2, '.', '');

        return (object) $item;
    }
}

