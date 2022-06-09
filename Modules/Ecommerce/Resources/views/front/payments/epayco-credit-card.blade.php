<form action="{{ route('creditcardepayco.store') }}" method="POST" id="customer-form">
    @csrf
    <div class="row py-4">
        <div class="col-12">
            <div class="form-group">
                <label class="text-sm " for="">Número de tarjeta</label>
                <input type="text" name="CREDIT_CARD_NUMBER" class="form-control" placeholder="XXXX XXXX XXXX XXXX"
                    aria-describedby="textHelp" minlength="13" required>
            </div>
            <div class="row mb-3 justify-content-center">
                @foreach ($creditCards as $item)
                <div class="col-3 d-flex">
                    <div class="form-check container-card">
                        <input class="" required type="radio" name="PAYMENT_METHOD" id="creditCard{{$item['icon']}}"
                            value="{{$item['description']}}">
                        <br>
                        <label class="form-check-label" for="creditCards{{$item['id']}}">
                            <img src="{{asset($item['icon'])}}" alt="{{$item['icon']}}"
                                style=" max-width: 37px; border-radius: 5px; ">
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <select class="form-control" required name="INSTALLMENTS_NUMBER">
                    <option value="">¿En cuantas cuotas deseas pagar?
                    </option>
                    <option id="totalCart" value="1"> </option>
                    <option value="2">2 cuotas</option>
                    <option value="3">3 cuotas</option>
                    <option value="4">4 cuotas</option>
                    <option value="5">5 cuotas</option>
                    <option value="6">6 cuotas</option>
                    <option value="7">7 cuotas</option>
                    <option value="8">8 cuotas</option>
                    <option value="9">9 cuotas</option>
                    <option value="10">10 cuotas</option>
                    <option value="11">11 cuotas</option>
                    <option value="12">12 cuotas</option>
                    <option value="24">24 cuotas</option>
                    <option value="36">36 cuotas</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-sm " for="">Nombre y Apellido como figura en la tarjeta</label>
                <input type="text" class="form-control" placeholder="Nombre y Apellido" required name="BUYER_NAME"
                    aria-describedby="textHelp">
            </div>
            <div class="w-100">
                <label class="text-sm " for="exampleFormControlSelect1">Fecha de
                    Vencimiento</label>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" required name="day">
                            <option value="">MM</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" required name="age">
                            <option value="">AA</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                            <option value="2035">2035</option>
                            <option value="2036">2036</option>
                            <option value="2037">2037</option>
                            <option value="2038">2038</option>
                            <option value="2039">2039</option>
                            <option value="2040">2040</option>
                            <option value="2041">2041</option>
                            <option value="2042">2042</option>
                            <option value="2043">2043</option>
                            <option value="2044">2044</option>
                            <option value="2045">2045</option>
                            <option value="2046">2046</option>
                            <option value="2047">2047</option>
                            <option value="2048">2048</option>
                            <option value="2049">2049</option>
                            <option value="2050">2050</option>
                            <option value="2051">2051</option>
                            <option value="2052">2052</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="billingAddress" value="{{ $billingAddress->id }}">
            @if(request()->has('courier'))
            <input type="hidden" name="courier" value="{{ request()->input('courier') }}">
            @endif
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-sm" for="">Código de Seguridad
                            tarjeta</label>
                        <input type="password" placeholder="****" class="form-control" required
                            name="CREDIT_CARD_SECURITY_CODE" aria-describedby="textHelp" size="4">
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-submit">Pagar</button>
                </div>
            </div>
        </div>
    </div>
</form>
