@extends('User.Layouts.headerfooter')
@section('content')
    <section style="height: 100vh;" class="bg-danger d-flex justify-content-center">
        <div class="card bg-transparent m-auto" style="width:50%">
            <div class="card-body text-center">
                <h1 class="card-title text-light">This is my cart</h1>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach ($carts as $key => $cart)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>
                                    {{ $cart->menu->name }}
                                    <br>
                                    <img src="{{ $cart->menu->image }}" alt="Item Image" style="width: 50px; height: 50px;">
                                </td>

                                <td>Rs.{{ $cart->price }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>Rs.{{ $cart->price * $cart->quantity }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php $total += $cart->price * $cart->quantity; @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        <p>Total: Rs.{{ $total }}</p>
                        <a href="{{ route('payment.index') }}" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
