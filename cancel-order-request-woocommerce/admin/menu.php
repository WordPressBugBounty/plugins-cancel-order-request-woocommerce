<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

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
        wp_enqueue_style( $this->plugin_name."_promotion", plugin_dir_url( __FILE__ ) . 'css/promotion.css', array(), $this->version, 'all' );
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
                            <div class="col-12 col-sm-2 py-2 d-flex align-items-center justify-content-center">
                                    <a href="https://www.piwebsolution.com/" target="_blank"><img id="pi-logo" class="img-fluid ml-2" src="<?php echo esc_url(plugin_dir_url( __FILE__ )); ?>img/pi-web-solution.svg"></a>
                            </div>
                            <div class="col-12 col-sm-10 d-flex text-center small">
                                <nav id="pisol-navbar" class="navbar navbar-expand-lg navbar-light mr-0 ml-auto">
                                    <div>
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <?php do_action($this->plugin_name.'_tab'); ?>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="pisol-row">
                <div class="col-12">
                <div class="bg-light border pl-3 pr-3 pt-0">
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
        $this->support();
    }

    function promotion(){
        ?>
        <div class="col-12 col-sm-4 col-xl-3 col-lg-4 pt-3 border-left">

        <div class="pisol-cor-banner">

            <div class="pisol-cor-stars" aria-label="5 star rating">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
            </div>

            <p class="pisol-cor-trust">
                <span class="pisol-cor-emoji">🚀</span> Trusted by <strong>3,000+</strong> WooCommerce Stores
            </p>
            <p class="pisol-cor-rating">Rated <strong>4.9/5</strong> — Users love it</p>

            <ul class="pisol-cor-features">
                <li><span class="pisol-cor-check">✓</span> Partial order cancellation</li>
                <li><span class="pisol-cor-check">✓</span> Disable cancel for specific product</li>
                <li><span class="pisol-cor-check">✓</span> Upload image with cancel request</li>
                <li><span class="pisol-cor-check">✓</span> Withdraw cancellation request</li>
                <li><span class="pisol-cor-check">✓</span> Disable cancel by payment method</li>
                <li><span class="pisol-cor-check">✓</span> Disable cancel by customer group</li>
                <li><span class="pisol-cor-check">✓</span> Set default action on repeat order</li>
                <li><span class="pisol-cor-check">✓</span> Redirect to cart/checkout on repeat</li>
                <li><span class="pisol-cor-check">✓</span> Auto refund to Wallet (TerraWallet)</li>
            </ul>

            <div class="pisol-cor-price">
                <span class="pisol-cor-price-amount"><?php echo esc_html(PISOL_CORW_PRICE); ?> </span>
                <span class="pisol-cor-price-label">only</span>
            </div>

            <a href="<?php echo esc_url(PISOL_CORW_BUY_URL); ?>" target="_blank" class="pisol-cor-cta">
                <span class="pisol-cor-lock">🔓</span> Unlock Pro Now — Limited Time Price!
            </a>

        </div>

            
            
        </div>
        
        <?php
    }

    function support(){
        $website_url = home_url();
        $plugin_name = $this->plugin_name;
        ?>
        <form action="https://www.piwebsolution.com/quick-support/" method="post" target="_blank" style="display:inline; position:fixed; bottom:30px; right:35px; z-index:9999;" >
            <input type="hidden" name="website_url" value="<?php echo esc_attr( $website_url ); ?>">
            <input type="hidden" name="plugin_name" value="<?php echo esc_attr( $plugin_name ); ?>">
            <button type="submit" style="background:none;border:none;cursor:pointer;padding:0;">
                <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>img/chat.png" 
                    alt="Live Support" title="Quick Support" style="width:60px;height:60px;">
            </button>
        </form>
        <?php
    }

}       