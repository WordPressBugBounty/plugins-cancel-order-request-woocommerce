<?php

class pisol_corw_menu{

    public $plugin_name;
    public $version;
    public $menu;
    
    function __construct($plugin_name , $version){
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action( 'admin_menu', array($this,'plugin_menu') );
        add_action($this->plugin_name.'_promotion', array($this,'promotion'));

        add_action( 'wp_ajax_pisol_bogo_search_product', array( $this, 'search_product' ) );
    }

    function plugin_menu(){
        
        $this->menu = add_submenu_page(
            'woocommerce',
            __( 'Cancel order request', 'cancel-order-request-woocommerce'),
            __( 'Cancel order request', 'cancel-order-request-woocommerce'),
            'manage_options',
            'pisol-cancel-order-request',
            array($this, 'menu_option_page')
        );

        add_action("load-".$this->menu, array($this,"bootstrap_style"));

 
    }

    public function bootstrap_style() {
        wp_enqueue_script( $this->plugin_name."_quick_save", plugin_dir_url( __FILE__ ) . 'js/pisol-quick-save.js', array('jquery'), $this->version, 'all' );
    }


    function menu_option_page(){
        if(function_exists('settings_errors')){
            settings_errors();
        }
        ?>
        <div class="bootstrap-wrapper clear">
        <div class="pisol-container-fluid mt-2">
            <div class="pisol-row">
                    <div class="col-12">
                        <div class='bg-dark'>
                        <div class="pisol-row">
                            <div class="col-12 col-sm-2 py-2">
                                    <a href="https://www.piwebsolution.com/" target="_blank"><img class="img-fluid ml-2" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/pi-web-solution.png"></a>
                            </div>
                            <div class="col-12 col-sm-10 d-flex text-center small">
                                <?php do_action($this->plugin_name.'_tab'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="pisol-row">
                <div class="col-12">
                <div class="bg-light border pl-3 pr-3 pb-3 pt-0">
                    <div class="pisol-row">
                        <div class="col">
                        <?php do_action($this->plugin_name.'_tab_content'); ?>
                        </div>
                        <?php do_action($this->plugin_name.'_promotion'); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    function promotion(){
        ?>
        <div class="col-12 col-sm-4 pt-3">

            
            <div class="pi-shadow">
                <div class="pisol-row justify-content-center">
                    <div class="col-md-7 col-sm-12">
                        <div class="p-2  text-center">
                            <img class="img-fluid" src="<?php echo esc_url(plugin_dir_url( __FILE__ )); ?>img/bg.svg">
                        </div>
                    </div>
                </div>
                <div class="text-center py-2">
                    <a class="btn btn-success btn-sm text-uppercase mb-2 " href="<?php echo esc_url(PISOL_CORW_BUY_URL); ?>&utm_ref=top_link" target="_blank">Buy Now !!</a>
                    <a class="btn btn-sm mb-2 btn-secondary text-uppercase" href="http://websitemaintenanceservice.in/cancel_demo/" target="_blank">Try Demo</a>
                </div>
                <h2 id="pi-banner-tagline" class="mb-0">Get Pro for <?php echo esc_html(PISOL_CORW_PRICE); ?> Only</h2>
             
                <div class="inside">
                    <ul class="pisol-pro-feature-list">
                    <li class="border-top h6 font-weight-light">Allow <strong class="font-weight-bold">partial order cancellation</Strong> request</li>
                    <li class="border-top h6 font-weight-light">Disable cancellation option for <strong class=" font-weight-bold">specific product</strong></li>
                    <li class="border-top h6 font-weight-light">Allow user to <strong  class="font-weight-bold">upload image file</strong> along with cancellation request</li>
                    <li class="border-top h6 font-weight-light">Give option to <strong class="font-weight-bold">Withdraw cancellation request</strong></li>
                    <li class="border-top h6 font-weight-light">Disable cancellation request option based on the <strong class="font-weight-bold">Payment method</strong></li>
                    <li class="border-top h6 font-weight-light">Disable cancellation request option based on the <strong class="font-weight-bold">Customer group</strong></li>
                    <li class="border-top h6 font-weight-light">Set <strong class="font-weight-bold">default action</strong> on repeat order</li>
                    <li class="border-top h6 font-weight-light">Redirect to cart or checkout page once repeat order product are added in cart</li>
                    <li class="border-top h6 font-weight-light"><strong  class="font-weight-bold">Auto process refund</strong> and issue refund in the Wallet balance (Support TerraWallet plugin)</li>
                    </ul>
                    <div class="text-center pb-3 pt-2">
                        <a class="btn btn-primary btn-lg" href="<?php echo PISOL_CORW_BUY_URL; ?>&utm_ref=bottom_link" target="_blank">BUY PRO VERSION</a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
    }

}       