<!-- Assuming $order is an instance of Order model with properties: name, amount, daily_income -->
<figure class="text bg-skin-primary rounded-xl my-4 relative overflow-hidden shadow-md">

    <img class="h-32 mx-auto object-container"
        src="https://images.unsplash.com/photo-1709888247000-222026030103?q=80&w=846&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8Mhttps://images.unsplash.com/photo-1709721821603-8f0f11ce3e0d?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3DHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="" width="384" height="512">
    <figcaption class="font-medium space-y-2 py-3 text-center text-skin-inverted">
        <p class="text-2xl font-bold uppercase">
            {{__('vip') }}
        </p>
        <p class="text-lg font-semibold uppercase">
            {{ __('Amount: :amount', ['amount' => $order->amount]) }}
        </p>
        <p class="text-lg font-semibold uppercase">
            {{ __('Daily income: :daily_income', ['daily_income' => $order->daily_income]) }}
        </p>
        <div class="mx-2">
            <form method="POST" action="{{ route('invest.store') }}">
                @csrf
                <input type="hidden" name="capital" value="{{ $order->amount }}">
                <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                <input type="hidden" name="order_id" value="{{ $order->id }}"> <!-- Add a hidden input for order ID -->
                <button type="submit" class="block w-full text-skin-base font-black text-xl uppercase bg-skin-button-accent px-4 rounded py-2">{{ __('Invest now') }}</button>
            </form>
        </div>
    </figcaption>
    <div class="absolute top-2 right-2 overflow-hidden">
        <button class="rounded-full bg-skin-button-accent text-skin-base px-4 py-2 cursor-none">
            {{ __(':days Days', ['days' => $order->days]) }}
        </button>
    </div>
</figure>

{{-- <script>id="investmentForm" id="investButton"
    document.addEventListener("DOMContentLoaded", function() {
        const investButton = document.getElementById('investButton');
        const investmentForm = document.getElementById('investmentForm');
        const userBalance = {{ Auth::user()->balance }};
        const investmentAmount = {{ $order->amount }};

        investButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            if (userBalance < investmentAmount) {
                alert('Insufficient balance. Please deposit more funds.');
            } else {
                investmentForm.submit(); // Submit the form if balance is sufficient
            }
        });
    });
</script> --}}