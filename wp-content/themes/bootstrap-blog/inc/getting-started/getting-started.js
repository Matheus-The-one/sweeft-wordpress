jQuery(document).ready(function($) {
    $( '.bootstrap-blog-install-plugins' ).click( function ( e ) {
        e.preventDefault();

        $( this ).addClass( 'updating-message' );
        $( this ).text( bootstrap_blog_adi_install.btn_text );

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action     : 'bootstrap_blog_getting_started',
                security : bootstrap_blog_adi_install.nonce,
                slug : 'advanced-import',
                filename : 'advanced-import',
                request : 1
            },
            
            success:function( response ) {
                setTimeout(function(){
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action : 'bootstrap_blog_getting_started',
                            security : bootstrap_blog_adi_install.nonce,
                            slug : 'blog-sidebar-widget',
                            filename : 'blog-sidebar-widget',
                            request : 2
                        },

                        success:function( response ) {
                            setTimeout(function(){

                                $.ajax( {
                                    type: "POST",
                                    url: ajaxurl,
                                    data: {
                                        action : 'bootstrap_blog_getting_started',
                                        security : bootstrap_blog_adi_install.nonce,
                                        slug : 'tbthemes-demo-import',
                                        filename : 'tbthemes-demo-import',
                                        request : 3
                                    },
                                    success:function( response ) {
                                        var extra_uri, redirect_uri, dismiss_nonce;
                                        setTimeout(function() {
                                            if ( $( '.bootstrap-blog-close' ).length ) {
                                                dismiss_nonce = $( '.bootstrap-blog-close' ).attr( 'href' ).split( 'bootstrap_blog_admin_notice_nonce=' )[1];
                                                extra_uri     = '&bootstrap_blog_admin_notice_nonce=' + dismiss_nonce;
                                            }
                                            redirect_uri         = response.data.redirect + extra_uri;
                                            window.location.href = redirect_uri;

                                        }, 2000 );
                                    },
                                    error: function( xhr, ajaxOptions, thrownError ){
                                        console.log( thrownError );
                                    }
                                } );

                            }, 2000 );
                            
                        },
                        error: function( xhr, ajaxOptions, thrownError ){
                            console.log( thrownError );
                        }

                    } );
                    

                }, 2000 );
            },
                       
            error: function( xhr, ajaxOptions, thrownError ){
                console.log(thrownError);
            }
        });
    } );


} );