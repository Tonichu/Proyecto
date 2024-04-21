<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Gimnasio</title>
    <link rel="stylesheet" href="../../public/css/prices/credit_card.css">
</head>

<body>
    <div class="container">
        <section class="payment-card" id="payment-card">
            <div class="front">
                <div class="brand-logo" id="brand-logo">
                    <!-- <img src="img/logos/visa.png" alt=""> -->
                </div>
                <img src="img/chip-card.png" class="chip" alt="">
                <div class="details">
                    <div class="group" id="card-number">
                        <p class="label">Nº Tarjeta</p>
                        <p class="number">#### ####</p>
                    </div>
                    <div class="flexbox">
                        <div class="group" id="card-holder">
                            <p class="label">
                                Titular de la tarjeta
                            </p>
                            <p class="name">Nombre</p>
                        </div>

                        <div class="group" id="expiration">
                            <p class="label">Expiracion</p>
                            <p class="expiration"><span class="month">MM</span> / <span class="year">YY</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="back">
                <div class="magnetic-stripe"></div>
                <div class="details">
                    <div class="group" id="signature">
                        <p class="label">FIRMA</p>
                        <div class="signature">
                            <p></p>
                        </div>
                    </div>
                    <div class="group" id="cvv">
                        <p class="label">CVV</p>
                        <p class="cvv"></p>
                    </div>
                </div>
                <p class="disclaimer">Esta es una tarjeta de crédito ficticia para hacer como que el usuario paga el
                    gimnasio.</p>
                <a href="#" class="bank-link">www.bbva.com</a>
            </div>
        </section>

        <div class="btn-container">
            <button class="btn-open-form" id="btn-open-form">
                <i class="fas fa-caret-down"></i>
            </button>
        </div>

        <form action="prices.php" id="payment-form" class="payment-form">
            <div class="group">
                <label for="inputCardNumber">Nº Tarjeta</label>
                <input type="text" id="inputCardNumber" maxlength="19" autocomplete="off">
            </div>
            <div class="group">
                <label for="inputCardHolder">Titular Tarjeta</label>
                <input type="text" id="inputCardHolder" maxlength="19" autocomplete="off">
            </div>
            <div class="flexbox">
                <div class="group expire">
                    <label for="selectMonth">Expiracion</label>
                    <div class="flexbox">
                        <div class="select-group">
                            <select name="month" id="selectMonth">
                                <option disabled selected>Mes</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="select-group">
                            <select name="year" id="selectYear">
                                <option disabled selected>Año</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                </div>

                <div class="group cvv">
                    <label for="inputCVV">CVV</label>
                    <input type="text" id="inputCVV" maxlength="3">
                </div>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>
    <div class="footer">
        <p id="frase-motivacional"></p>
    </div>
    <script src="../../public/js/prices/motivationalQuotes.js"></script>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="../../public/js/prices/credit_card.js"></script>
</body>

</html>