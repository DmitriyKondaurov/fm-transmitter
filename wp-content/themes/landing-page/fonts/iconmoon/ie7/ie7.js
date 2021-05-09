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
		'icon-moonvoice1': '&#xe900;',
		'icon-moonradio': '&#xe901;',
		'icon-moonphone_bluetooth_speaker': '&#xe902;',
		'icon-mooncharg66': '&#xe903;',
		'icon-mooncard1': '&#xe904;',
		'icon-moonbluetooth_connected': '&#xe905;',
		'icon-moonaux10': '&#xe906;',
		'icon-moonaux5': '&#xe907;',
		'icon-moonuniE259': '&#xe259;',
		'icon-moonuniE114': '&#xe114;',
		'icon-moonuniE014': '&#xe014;',
		'icon-moonuniE013': '&#xe013;',
		'icon-mooncamera': '&#xe90f;',
		'icon-moonheadphones': '&#xe910;',
		'icon-moonmusic': '&#xe911;',
		'icon-moonmic': '&#xe91e;',
		'icon-mooncart': '&#xe93a;',
		'icon-mooncredit-card': '&#xe93f;',
		'icon-moonlocation': '&#xe947;',
		'icon-moonwrench': '&#xe991;',
		'icon-mooncog': '&#xe994;',
		'icon-mooncogs': '&#xe995;',
		'icon-moonfire': '&#xe9a9;',
		'icon-moonpower': '&#xe9b5;',
		'icon-mooncheckmark2': '&#xea11;',
		'icon-moonfacebook': '&#xea91;',
		'icon-mooninstagram': '&#xea92;',
		'icon-moontwitter': '&#xea96;',
		'icon-moonyoutube': '&#xea9d;',
		'icon-moondropbox': '&#xeaae;',
		'icon-mooncloud': '&#xeaaf;',
		'icon-moongithub': '&#xeab0;',
		'icon-moonwordpress': '&#xeab4;',
		'icon-moonapple': '&#xeabe;',
		'icon-moonandroid': '&#xeac0;',
		'icon-moonwindows': '&#xeac2;',
		'icon-moonlinkedin': '&#xeac9;',
		'icon-moonpinterest': '&#xead2;',
		'icon-moonchrome': '&#xead9;',
		'icon-moongit': '&#xeae7;',
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
		c = c.match(/icon-moon[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
