<footer>
<hr>

<!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
<?php include("config.php"); ?>
<p class="pull-right"><?php echo $PRO_NAME?></p>

<p>&copy; 2013 <a href="http://user.qzone.qq.com/744647295/infocenter" target="_blank"><?php echo $PRO_DEV?></a></p>
</footer>
<script type="text/javascript">
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        var path = options.path ? '; path=' + options.path : '';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
	$(".nav-header[data-toggle='collapse']").click(function() {
		var href = $(this).attr("href").replace('#','');
		$.cookie("Navhref",href);
	});
	$(".nav-header").click(function() {
		var href = $(this).attr("href").replace('#','');
		$.cookie("Navhref",href);
	});	
    function closeNavListI() {
    	$(".nav-header").addClass('collapsed');
    	$(".nav-list").removeClass('in');
    }	
    function openNavListI(number) {
        document.getElementById(number + "_p").className = "nav-header";
        document.getElementById(number).className += " in";
    }
    window.onload = function() {
    	closeNavListI();
    	var openNavNumber = $.cookie('Navhref');	
    	openNavListI(openNavNumber);
    }
</script>