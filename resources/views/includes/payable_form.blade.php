<form class="modal ajax bounceIn animated" id="pay-modal" method="POST" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-danger">

        <div class="modal-content">

            <div class="modal-header">
                <h3> Pay <i class='fas fa-money'></i> </h3>
            </div>

            <div class="modal-body">

                <div class="card-wrapper"></div>

                <div class="form-group">

                    <label for="card_holdername"> Card Holdername </label>

                    <input type="text" name="card_holdername" id="card_holdername" class="form-control" placeholder="Card Holdername" paymob_field="card_holdername"
                        value="Test Account">

                </div>

                <div class="form-group">

                    <label for="card_number"> Card Number </label>

                    <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Card Number"
                    paymob_field="card_number" value="4987654321098769">

                </div>

                <div class="form-group">

                    <label for="card_expiry_mm"> Card Month </label>

                    <input type="number" name="card_expiry_mm" id="card_expiry_mm" class="form-control" placeholder="Card Month" paymob_field="card_expiry_mm" value="05" min=1 max=12>

                </div>

                <div class="form-group">

                    <label for="card_expiry_yy"> Card Year </label>

                    <input type="number" name="card_expiry_yy" id="card_expiry_yy" class="form-control" placeholder="Card Year" paymob_field="card_expiry_yy" value="21">

                </div>

                <div class="form-group">

                    <label for="card_cvn"> Card CVN </label>

                    <input type="number" name="card_cvn" id="card_cvn" class="form-control" placeholder="Card CVN" paymob_field="card_cvn" value="123">

                </div>

                <input type="hidden" value="CARD" paymob_field="subtype">

            </div>

            <button class="btn-submit btn"> </button>

        </div>
    </div>
</form>