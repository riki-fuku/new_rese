<script src="https://js.stripe.com/v3/"></script>
<x-app-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">

            <div class="font-black text-2xl">
                決済({{ $reservation->shop->name }})
            </div>

            <form action="{{ route('payment.store') }}" method="post" id="payment-form">
                @csrf

                <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">

                {{-- TODO::決済処理未実装 --}}
                {{-- <div class="form-row">
                    <div id="card-element"></div>

                    <!-- カードエラーを表示するための要素 -->
                    <div id="card-errors" role="alert"></div>
                </div> --}}

                <div class="mt-4">
                    <!-- 支払金額 -->
                    <label class="block" for="amount">支払金額</label>
                    <x-input type="text" name="amount" id="amount" class="w-full py-2 rounded-lg"
                        :value="old('amount')" />

                    <!-- カード番号 -->
                    <label class="block mt-5" for="card_number">カード番号</label>
                    <input type="text" name="card_number" id="card_number" class="w-full py-2 rounded-lg"
                        placeholder="1234 1234 1234 1234">

                    <!-- 有効期限 -->
                    <label class="block mt-5" for="card_expiry">有効期限</label>
                    <input type="text" name="card_expiry" id="card_expiry" class="w-1/2 py-2 rounded-lg"
                        placeholder="月 / 年">

                    <!-- セキュリティコード -->
                    <label class="block mt-5" for="security_code">セキュリティコード</label>
                    <input type="text" name="security_code" id="security_code" class="w-1/2 py-2 rounded-lg"
                        placeholder="CVC">
                </div>

                <div class="w-36 mt-5 m-auto bg-blue-700 rounded-lg hover:bg-blue-900 active:bg-gray-700">
                    <input type="submit" value="支払い" class="w-full py-3 text-white text-center">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    var stripePublicKey = "{{ config('stripe.stripe_public_key') }}";
    var stripe = Stripe(stripePublicKey);
    var elements = stripe.elements();
    var card = elements.create('card');

    card.mount('#card-element');

    var form = document.getElementById('payment-form');

    // stripeのトークンを作成するだけの処理
    function createStripeToken() {

        if (!card._element) {
            console.error('Card element is not mounted.');
            return;
        }

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // エラーを表示
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // トークンをサーバーに送信
                stripeTokenHandler(result.token);
            }
        });
    }

    function stripeTokenHandler(token) {
        // トークンIDを隠しフィールドに挿入
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // フォームを送信
        form.submit();
    }
</script>
