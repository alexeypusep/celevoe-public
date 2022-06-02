@extends('layouts.add')

@section('title', 'Корзина')

@section('content')

<div class="container my-5 py-3 z-depth-1 rounded">
    <!--Section: Content-->
    <section class="dark-grey-text">
        <!-- Shopping Cart table -->
        <div class="table-responsive">
            <table class="table product-table mb-0">
                <!-- Table head -->
                <thead class="mdb-color lighten-5">
                <tr>
                    <th></th>
                    <th class="font-weight-bold">
                        <strong>Наименование</strong>
                    </th>
                    <th class="font-weight-bold">
                        <strong>Вес</strong>
                    </th>
                    <th></th>
                    <th class="font-weight-bold">
                        <strong>Цена</strong>
                    </th>
                    <th class="font-weight-bold">
                        <strong>Количество</strong>
                    </th>
                    <th class="font-weight-bold">
                        <strong>Сумма</strong>
                    </th>
                    <th></th>
                </tr>
                </thead>
                <!-- /.Table head -->
                <!-- Table body -->
                <tbody>

                <?php $total = 0;?>

                @foreach($baskets as $basket)

                <!-- First row -->
                <tr>
                    <th scope="row">
                        <img src="{{ $basket->tovars['photo1'] }}" alt="" class="img-fluid z-depth-0" style="width: 100px">
                    </th>
                    <td>
                        <h5 class="mt-3">
                            <strong>{{ $basket->tovars['naim'] }}</strong>
                        </h5>
                        <p class="text-muted">{{ $basket->tovars['category'] }}</p>
                        <p class="text-muted"><strong>Примечание</strong></p>
                        <p class="text-muted">{{ $basket['comment'] }}</p>
                    </td>
                    <td>{{ $basket->tovars['mass'] }}</td>
                    <td></td>
                    <td>{{ $basket->tovars['price'] }}₽</td>
                    <td>{{ $basket['amount'] }}</td>
                    <td class="font-weight-bold">
                        <?php
                            $summ = $basket['amount'] * $basket->tovars['price'];
                        ?>
                        <strong>{{ $summ }}₽</strong>
                    </td>
                    <td>
                        <form action="{{ route('basket.destroy', $basket['id_korsin']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm waves-effect">
                                <i class="fas fa-lg red-text fa-window-close"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php
                    $total += $summ;
                ?>
                <!-- /.First row -->
                @endforeach
                <!-- Fourth row -->
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <h4 class="mt-2">
                            <strong>Итого</strong>
                        </h4>
                    </td>
                    <td class="text-right">
                        <h4 class="mt-2">
                            <?php session(['total' => $total]) ?>
                            <strong>{{ $total }}₽</strong>
                        </h4>
                    </td>
                    <td colspan="3" class="text-right">
                        <form action="{{ route('shoregorder') }}" method="post">
                            @csrf
                            <button @if($total <= 0) disabled @endif class="btn blue-gradient btn-rounded">Оформить заказ
                                <i class="fas fa-angle-right right"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <!-- Fourth row -->
                </tbody>
                <!-- /.Table body -->
            </table>
        </div>
        <!-- /.Shopping Cart table -->
    </section>
    <!--Section: Content-->
</div>

@endsection
