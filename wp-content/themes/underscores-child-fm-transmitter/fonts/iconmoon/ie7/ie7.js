/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-voice1': '&#xe900;',
		'icon-radio': '&#xe901;',
		'icon-phone_bluetooth_speaker': '&#xe902;',
		'icon-charg66': '&#xe903;',
		'icon-card1': '&#xe904;',
		'icon-bluetooth_connected': '&#xe905;',
		'icon-aux10': '&#xe906;',
		'icon-aux5': '&#xe907;',
		'icon-camera': '&#xe90f;',
		'icon-headphones': '&#xe910;',
		'icon-music': '&#xe911;',
		'icon-mic': '&#xe91e;',
		'icon-cart': '&#xe93a;',
		'icon-credit-card': '&#xe93f;',
		'icon-location': '&#xe947;',
		'icon-wrench': '&#xe991;',
		'icon-cog': '&#xe994;',
		'icon-cogs': '&#xe995;',
		'icon-fire': '&#xe9a9;',
		'icon-power': '&#xe9b5;',
		'icon-checkmark2': '&#xea11;',
		'icon-facebook': '&#xea91;',
		'icon-instagram': '&#xea92;',
		'icon-twitter': '&#xea96;',
		'icon-youtube': '&#xea9d;',
		'icon-dropbox': '&#xeaae;',
		'icon-cloud': '&#xeaaf;',
		'icon-github': '&#xeab0;',
		'icon-wordpress': '&#xeab4;',
		'icon-apple': '&#xeabe;',
		'icon-android': '&#xeac0;',
		'icon-windows': '&#xeac2;',
		'icon-linkedin': '&#xeac9;',
		'icon-pinterest': '&#xead2;',
		'icon-chrome': '&#xead9;',
		'icon-git': '&#xeae7;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
