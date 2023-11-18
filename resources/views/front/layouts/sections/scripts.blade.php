@vite('resources/js/front/jquery-3.6.0.min.js')
@vite('resources/js/front/jquery.formstyler.min.js')
@vite('resources/js/front/slick.min.js')
@vite('resources/js/front/bootstrap.min.js')
@vite('resources/js/front/jquery.sticky.js')

<script>
    $(document).ready(function(){
        $(".btn_nav_recipe").sticky({topSpacing:0});
    });
</script>
@vite('resources/js/front/custom.js')
<script>
    $(document).on('click', 'a[href^="#"]', function (e) {
        e.preventDefault();
        $('html, body').stop().animate({
            scrollTop: $($(this).attr('href')).offset().top -  70
        }, 600, 'linear');
    });

    $(function(){
        const hash = window.location.hash;
        if(hash == "#open_error"){
            $('#error_recipe_modal').toggleClass('show');
        }
    });
</script>

@php
    $needlazy = true;
@endphp

@if($needlazy)
    @vite('resources/js/front/jquery.lazy.min.js')
    <script>
        $(function(){
            $(".lazy").Lazy();
        });
    </script>
@endif
