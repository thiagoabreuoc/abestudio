document.addEventListener( 'DOMContentLoaded', function () {
	var toggle = document.querySelector( '[data-nav-toggle]' );
	var drawer = document.querySelector( '[data-nav-drawer]' );
	var overlay = document.querySelector( '[data-nav-overlay]' );
	var closeBtn = document.querySelector( '[data-nav-close]' );

	if ( ! toggle || ! drawer ) {
		return;
	}

	function openDrawer() {
		drawer.classList.add( 'is-open' );
		if ( overlay ) {
			overlay.classList.add( 'is-open' );
		}
		toggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
	}

	function closeDrawer() {
		drawer.classList.remove( 'is-open' );
		if ( overlay ) {
			overlay.classList.remove( 'is-open' );
		}
		toggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
	}

	toggle.addEventListener( 'click', function () {
		var isOpen = drawer.classList.contains( 'is-open' );
		if ( isOpen ) {
			closeDrawer();
		} else {
			openDrawer();
		}
	} );

	if ( closeBtn ) {
		closeBtn.addEventListener( 'click', closeDrawer );
	}

	if ( overlay ) {
		overlay.addEventListener( 'click', closeDrawer );
	}

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key ) {
			closeDrawer();
		}
	} );
} );

document.addEventListener( 'DOMContentLoaded', function () {
	var quoteText = document.querySelector( '.hero-quote-text' );

	if ( ! quoteText || ! quoteText.dataset.phrases ) {
		return;
	}

	var phrases = quoteText.dataset.phrases.split( '|' );
	var phraseIndex = 0;

	var WORD_DELAY = 220;
	var HOLD_TIME = 5000;
	var FADE_OUT_TIME = 350;

	function showPhrase() {
		var words = phrases[ phraseIndex ].split( ' ' );

		quoteText.innerHTML = '';

		var wordEls = words.map( function ( word ) {
			var span = document.createElement( 'span' );
			span.className = 'hero-quote-word';
			span.textContent = word;
			quoteText.appendChild( span );
			quoteText.appendChild( document.createTextNode( ' ' ) );
			return span;
		} );

		wordEls.forEach( function ( span, i ) {
			setTimeout( function () {
				span.classList.add( 'is-visible' );
			}, i * WORD_DELAY );
		} );

		var revealDuration = ( wordEls.length - 1 ) * WORD_DELAY + 500;

		setTimeout( function () {
			wordEls.forEach( function ( span ) {
				span.classList.remove( 'is-visible' );
				span.classList.add( 'is-hiding' );
			} );

			setTimeout( function () {
				phraseIndex = ( phraseIndex + 1 ) % phrases.length;
				showPhrase();
			}, FADE_OUT_TIME );
		}, revealDuration + HOLD_TIME );
	}

	showPhrase();
} );

document.addEventListener( 'DOMContentLoaded', function () {
	var switcher = document.querySelector( '[data-theme-switcher]' );
	var toggle = document.querySelector( '[data-theme-switcher-toggle]' );

	if ( ! switcher || ! toggle ) {
		return;
	}

	var options = switcher.querySelectorAll( '[data-theme-option]' );
	var STORAGE_KEY = 'abeTheme';

	function applyTheme( theme ) {
		if ( theme && 'default' !== theme ) {
			document.documentElement.setAttribute( 'data-abe-theme', theme );
		} else {
			document.documentElement.removeAttribute( 'data-abe-theme' );
		}

		options.forEach( function ( option ) {
			option.setAttribute( 'aria-pressed', option.dataset.themeOption === theme ? 'true' : 'false' );
		} );
	}

	function closePanel() {
		switcher.classList.remove( 'is-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );
	}

	toggle.addEventListener( 'click', function () {
		var isOpen = switcher.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
	} );

	options.forEach( function ( option ) {
		option.addEventListener( 'click', function () {
			var theme = option.dataset.themeOption;
			applyTheme( theme );

			try {
				localStorage.setItem( STORAGE_KEY, theme );
			} catch ( e ) {}
		} );
	} );

	document.addEventListener( 'click', function ( event ) {
		if ( ! switcher.contains( event.target ) ) {
			closePanel();
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key ) {
			closePanel();
		}
	} );

	var validThemes = Array.prototype.map.call( options, function ( option ) {
		return option.dataset.themeOption;
	} );

	var stored = null;
	try {
		stored = localStorage.getItem( STORAGE_KEY );
	} catch ( e ) {}

	applyTheme( -1 !== validThemes.indexOf( stored ) ? stored : 'default' );
} );
