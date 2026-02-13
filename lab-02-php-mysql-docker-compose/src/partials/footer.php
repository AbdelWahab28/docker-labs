<footer>
    <!-- Copyright -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p class="copyright-text">
                        © All rights reserved 2024-2025 &amp; Developed by 
                        <a rel="nofollow" href="http://graygrids.com">Abdourahamane AbdelWahab</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
</footer>

<!-- Go To Top Link -->
<a href="#" class="back-to-top">
    <i class="fa fa-arrow-up"></i>
</a>

<!-- JS Libraries -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/color-switcher.js"></script>
<script src="../assets/js/jquery.mixitup.js"></script>
<script src="../assets/js/wow.js"></script>
<script src="../assets/js/nivo-lightbox.min.js"></script>
<script src="../assets/js/jquery.countdown.js"></script>
<script src="../assets/js/jquery.counterup.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/form-validator.min.js"></script>
<script src="../assets/js/contact-form-script.js"></script>
<script src="../assets/js/jquery.slicknav.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/bootstrap-select.min.js"></script>

<!-- Script pour changer dynamiquement le formulaire selon la sélection -->
<script>
$(function () {
    $('#select').on('change', function() {
        $.ajax({
            url: 'form2.php',
            type: 'POST',
            data: { action: $(this).val() },
            dataType: 'html',
            success: function(data) {
                $('#formInput').html(data);
            },
            error: function(err) {
                console.error('Erreur AJAX: ', err.responseText);
            }
        });
    });
});
</script>

<!-- Script pour la recherche dynamique -->
<script>
$(document).ready(function() {
    var $input = $('input[name=rech]');
    $input.keyup(function() {
        var critere = $.trim($input.val());
        if(critere !== '') {
            $.get('recherche.php', { critere: critere }, function(retour) {
                $('#resultat').html(retour).fadeIn();
            });
        } else {
            $('#resultat').fadeOut();
        }
    });
});
</script>

</body>
</html>
