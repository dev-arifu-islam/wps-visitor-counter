( function( wp ) {
    var registerBlockType = wp.blocks.registerBlockType;
    var el = wp.element.createElement;
    var __ = wp.i18n.__;

    registerBlockType( 'wps/wps-visitor-counter', {
        title: __( 'WPS Visitor Counter', 'wps-visitor-counter' ),
        icon: 'chart-bar',
        category: 'widgets',
        keywords: [
            __( 'visitor', 'wps-visitor-counter' ),
            __( 'counter', 'wps-visitor-counter' ),
            __( 'statistics', 'wps-visitor-counter' ),
        ],
        attributes: {
            className: {
                type: 'string',
                default: '',
            },
        },
        edit: function( props ) {
            return el(
                'div',
                {
                    className: props.className,
                    style: {
                        backgroundColor: '#f8f9fa',
                        padding: '20px',
                        border: '1px solid #dee2e6',
                        borderRadius: '4px',
                        textAlign: 'center'
                    }
                },
                el( 'p', { style: { margin: 0, fontWeight: 'bold' } }, __( 'WPS Visitor Counter', 'wps-visitor-counter' ) ),
                el( 'p', { style: { margin: '10px 0 0 0', fontSize: '14px', color: '#6c757d' } }, __( 'Visitor counter will be displayed here on the frontend.', 'wps-visitor-counter' ) )
            );
        },
        save: function( props ) {
            return el( 'div', { className: props.className }, '[wps_visitor_counter]' );
        },
    } );
} )(
    window.wp
);