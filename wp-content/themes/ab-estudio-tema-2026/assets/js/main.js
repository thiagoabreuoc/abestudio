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
	var wrap = document.querySelector( '.whatsapp-wrap' );

	if ( ! wrap ) {
		return;
	}

	// Acima de 768px o botão nasce no rodapé da tela; assim que a página
	// começa a rolar, sobe e se fixa no meio da tela (classe .is-scrolled,
	// ver CSS). Abaixo de 769px a classe não tem efeito (a media query
	// que a usa só existe para min-width:769px).
	var mq = window.matchMedia( '(min-width: 769px)' );

	function update() {
		if ( mq.matches && window.scrollY > 0 ) {
			wrap.classList.add( 'is-scrolled' );
		} else {
			wrap.classList.remove( 'is-scrolled' );
		}
	}

	window.addEventListener( 'scroll', update, { passive: true } );
	window.addEventListener( 'resize', update );
	update();
} );
