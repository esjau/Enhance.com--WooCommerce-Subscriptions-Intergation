<?php
namespace Vortex;
if (!defined('ABSPATH')) {
    exit;
}
class Admin
{
    public function __construct()
    {
        add_action("admin_menu", [$this, "add_menu_item"]);


        add_action("admin_init", [$this, "register_settings"]);

        add_action("admin_post_test_api_call", [$this, "test_api_call"]);
    }

    public function add_menu_item()
    {
        add_menu_page(
            "Enhance Panel",
            "Enhance Panel",
            "manage_options",
            "enhance-panel",
            [$this, "panel_page"],
            "dashicons-admin-tools"
        );
    }

    public function panel_page()
    {
        $ownerName = $this->get_name();
        $websitesCount = $this->websitesCount();
        ?>
		
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="width: 100%; max-width: 400px; padding: 32px; background-color: white; border-radius: 8px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1); transition: transform 0.5s ease-in-out;">
        <h2 style="font-size: 20px; font-weight: bold; color: #2D3748; margin-bottom: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="159px" height="29px" viewBox="0 0 159 29" version="1.1">
    <!-- Generator: Sketch 55.2 (78181) - https://sketchapp.com -->
    <title>enhancewhite</title>
    <desc>Created with Sketch.</desc>
    <g id="Logs" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="enhancewhite" fill-rule="nonzero">
            <path d="M55.9982933,17.7538468 C56.006713,18.0951732 55.8712936,18.4243798 55.6249785,18.6613804 C55.3678629,18.9032575 55.0244888,19.0325022 54.6713289,19.0203303 L43.6890865,19.0203303 C43.8630654,20.2990706 44.5183014,21.4637986 45.5217228,22.2779697 C47.0859887,23.5006793 49.1648253,23.8487287 51.0433879,23.2024349 C51.597864,23.0275542 52.1204316,22.7645572 52.5909474,22.4235814 C52.8627906,22.2114011 53.1995199,22.0990058 53.544597,22.1052674 C53.8597597,22.0884694 54.1694135,22.1926724 54.4100086,22.3964909 C54.7256071,22.6248971 54.9173593,22.9863004 54.9292555,23.3751372 C54.9286241,23.7225017 54.7558216,24.0470629 54.4677027,24.242035 C53.7330208,24.8024771 52.9061742,25.231035 52.0241877,25.5085185 C49.707036,26.3152181 47.1578599,26.1225785 44.9889007,24.9768663 C43.7649245,24.321423 42.7492134,23.3372673 42.0566828,22.1357443 C41.3406032,20.8801922 40.976055,19.4556105 41.00122,18.0112071 C40.9779018,16.5698661 41.3211853,15.1461537 41.9989887,13.8731246 C42.6360957,12.6805507 43.5970403,11.6912023 44.7716994,11.0184573 C46.0011622,10.3280558 47.3929335,9.97737004 48.8034992,10.0025614 C50.1513497,9.96682387 51.4826231,10.3056529 52.6486415,10.9812078 C53.7255449,11.634569 54.5886969,12.5864225 55.1328817,13.7207403 C55.7292366,14.9829195 56.0254025,16.3654693 55.9982933,17.7606194 L55.9982933,17.7538468 Z M48.8034992,12.4745747 C47.5576705,12.4198433 46.3363239,12.8317014 45.3791844,13.6293096 C44.4829589,14.4339697 43.8950673,15.5245683 43.7162367,16.7142467 L53.3579396,16.7142467 C53.2439885,15.5511624 52.7336796,14.4622641 51.9121932,13.6293096 C51.0761909,12.8390173 49.9539131,12.4221434 48.8034992,12.4745747 Z" id="Shape" fill="#FFFFFF"/>
            <path d="M65.4216562,10.0009894 C66.6010152,9.98045485 67.7657564,10.2798512 68.8053207,10.8707594 C69.8058975,11.4501421 70.6220948,12.3309504 71.1508154,13.4019259 C71.7437315,14.6413462 72.034546,16.018451 71.9967315,17.4076242 L71.9967315,24.5254681 C71.9967315,25.3398296 71.3741231,26 70.6060967,26 C69.8380703,26 69.2154619,25.3398296 69.2154619,24.5254681 L69.2154619,17.4076242 C69.2154619,15.8447563 68.8192057,14.6635453 68.0266934,13.8639911 C67.1676915,13.0382379 66.0351297,12.6069928 64.8769375,12.6646599 C64.1538605,12.6540002 63.4384435,12.8227024 62.7877811,13.1573031 C62.1941639,13.4538617 61.6855018,13.912309 61.3138363,14.4857408 C60.9612692,15.0417659 60.7758253,15.6979948 60.7819345,16.3679773 L60.7819345,24.5220706 C60.7934648,24.914223 60.656099,25.2948795 60.4006314,25.5787052 C60.1349432,25.8628926 59.7683047,26.0146933 59.3912997,25.9966025 C59.0190212,26.0089919 58.6584782,25.857622 58.3951079,25.5783626 C58.1317377,25.2991032 57.9889803,24.9168086 58.0006648,24.5220706 L58.0006648,11.6114229 C57.9919764,11.2212205 58.1344072,10.8442754 58.3947849,10.5683784 C58.6624616,10.2974984 59.0214597,10.1518453 59.3912997,10.1640713 C59.7668989,10.1388835 60.1345832,10.2861286 60.4007026,10.568303 C60.666822,10.8504774 60.8056892,11.240344 60.7819345,11.6386032 L60.7819345,11.927394 C61.3736151,11.3046707 62.0791008,10.8167633 62.8550698,10.4936326 C63.6733357,10.1581041 64.5443869,9.9909103 65.4216562,10.0009894 L65.4216562,10.0009894 Z" id="Path" fill="#FFFFFF"/>
            <path d="M82.4220701,9.71820192 C83.6013549,9.6974009 84.7660228,10.0006819 85.8055217,10.5992571 C86.8060355,11.1861572 87.6221815,12.0783939 88.1508688,13.1632652 C88.7437476,14.418767 89.0345438,15.8137395 88.9967317,17.2209371 L88.9967317,24.4311345 C89.0213639,24.9824995 88.7615405,25.5036911 88.3206609,25.7872962 C87.8797812,26.0709013 87.3293835,26.0709013 86.8885039,25.7872962 C86.4476242,25.5036911 86.1878009,24.9824995 86.212433,24.4311345 L86.212433,17.2209371 C86.212433,15.6377912 85.8172698,14.441254 85.0269433,13.6313257 C84.1670123,12.7943267 83.0333392,12.3574745 81.8741816,12.4164333 C81.1522171,12.4060455 80.4379725,12.5769294 79.7883606,12.9154684 C79.1947807,13.215875 78.6861506,13.6802705 78.3145085,14.2611425 C77.9604818,14.8236285 77.774908,15.4888796 77.7826402,16.1678009 L77.7826402,24.4276929 C77.7941698,24.8249335 77.6568126,25.2105289 77.4013611,25.4980372 C77.0022823,25.9402827 76.3921437,26.07567 75.8625917,25.839484 C75.3330397,25.6032979 74.9916256,25.0435075 75.0015455,24.4276929 L75.0015455,4.50414511 C74.9833508,4.09596031 75.1264716,3.69850172 75.3956407,3.40970942 C75.9675009,2.86343019 76.8295009,2.86343019 77.4013611,3.40970942 C77.6611906,3.70121857 77.7989167,4.09406567 77.7826402,4.49726187 L77.7826402,11.6696014 C78.3742836,11.0387983 79.0797249,10.5445603 79.8556451,10.2172371 C80.6738595,9.87735516 81.5448559,9.70799201 82.4220701,9.71820192 Z" id="Path" fill="#FFFFFF"/>
            <path d="M100.023599,10.0007299 C102.874785,9.96205116 105.52241,11.4631367 106.937952,13.9208605 C107.649826,15.1630416 108.015805,16.5710034 107.998289,18.0000984 L107.998289,24.4320918 C108.0245,24.9744273 107.748019,25.4870836 107.278873,25.7660442 C106.809728,26.0450048 106.224043,26.0450048 105.754897,25.7660442 C105.285752,25.4870836 105.00927,24.9744273 105.035482,24.4320918 L105.035482,23.3758908 C103.668348,25.052156 101.606059,26.0180336 99.4337654,25.999467 C98.0964672,26.0158226 96.7818912,25.65547 95.6424637,24.9601923 C94.5053941,24.2646392 93.5820807,23.2729417 92.9728691,22.0928773 C92.3180137,20.8385094 91.9842938,19.4433401 92.0011775,18.0305658 C91.9766177,16.5931419 92.3366306,15.1749865 93.0444674,13.9208605 C93.7270724,12.7225227 94.7253676,11.7313087 95.9322664,11.0535456 C97.1768136,10.3459624 98.5895801,9.98241762 100.023599,10.0007299 L100.023599,10.0007299 Z M100.023599,23.3995876 C101.894355,23.4213783 103.620089,22.4019092 104.49338,20.759085 C104.951793,19.9138373 105.186428,18.966813 105.175269,18.0068689 C105.18489,17.0427913 104.950417,16.091763 104.49338,15.2411118 C103.830452,14.0292252 102.699596,13.1371899 101.36076,12.7700573 C100.021923,12.4029246 98.5902792,12.5922768 97.3949179,13.2945875 C96.6110388,13.7663623 95.9692713,14.4386535 95.5367709,15.2411118 C95.076673,16.0905983 94.8420042,17.0424202 94.8548821,18.0068689 C94.8406974,18.9671572 95.0755166,19.9149263 95.5367709,20.759085 C95.9712399,21.5565724 96.6128378,22.2240105 97.3949179,22.6920683 C98.1880063,23.1656276 99.0982128,23.4106131 100.023599,23.3995876 Z" id="Shape" fill="#FFFFFF"/>
            <path d="M118.428937,10.0009453 C119.605926,9.9809335 120.768244,10.2789395 121.805656,10.8667004 C122.807367,11.4413941 123.624186,12.3185778 124.151755,13.386183 C124.744015,14.6198822 125.034508,15.9906302 124.996735,17.3733909 L124.996735,24.4583788 C125.021342,25.000169 124.761789,25.5123099 124.32137,25.7909899 C123.880951,26.06967 123.331127,26.06967 122.890708,25.7909899 C122.450289,25.5123099 122.190736,25.000169 122.215343,24.4583788 L122.215343,17.3733909 C122.215343,15.8177373 121.820592,14.6419788 121.031091,13.8461154 C120.168865,13.0202608 119.031123,12.59075 117.868817,12.6523203 C117.147606,12.6421129 116.434107,12.8100293 115.785174,13.1426894 C115.192213,13.4378791 114.684114,13.8942102 114.31286,14.464995 C113.959203,15.0177131 113.773823,15.6714116 113.781547,16.3385431 L113.781547,24.454997 C113.793064,24.8453392 113.655851,25.2242385 113.400666,25.5067541 C113.001122,25.9401658 112.391906,26.0724819 111.862959,25.8407297 C111.334012,25.6089775 110.992182,25.0599711 111.000155,24.454997 L111.000155,11.603945 C110.994525,11.2128096 111.142908,10.8367761 111.409842,10.5657153 C111.80644,10.1241369 112.420617,9.98868355 112.951281,10.2257592 C113.481946,10.4628348 113.817861,11.022744 113.79435,11.6309998 L113.79435,11.9184576 C114.38486,11.2979357 115.089705,10.812184 115.865191,10.4913144 C116.682551,10.1573348 117.552638,9.99091273 118.428937,10.0009453 L118.428937,10.0009453 Z" id="Path" fill="#FFFFFF"/>
            <path d="M136.093002,25.9966118 C134.634905,26.0192618 133.196911,25.6601236 131.926446,24.9560165 C130.710357,24.2815744 129.709172,23.2874792 129.035015,22.0850581 C128.339434,20.8396442 127.983267,19.4384241 128.001131,18.0175845 C127.977452,16.5748637 128.326047,15.1497883 129.014338,13.8755406 C129.663506,12.6788959 130.644654,11.6880378 131.843736,11.0181404 C133.097881,10.3287043 134.515154,9.97787876 135.951705,10.001272 C138.171909,9.9601949 140.290277,10.9158614 141.706996,12.597676 C141.898347,12.8027586 142.003093,13.0718259 142.000067,13.3501586 C141.988445,13.792948 141.742817,14.197732 141.352029,14.4178704 C141.154562,14.5515341 140.919689,14.6214285 140.680004,14.6178545 C140.236398,14.6141238 139.817822,14.4151215 139.539285,14.0755247 C139.095022,13.5879853 138.549777,13.1996507 137.94021,12.9366321 C137.311306,12.6855163 136.637245,12.5621469 135.958597,12.573949 C134.578358,12.5267157 133.244891,13.0693708 132.302091,14.0619665 C131.364702,15.0517184 130.894859,16.3646084 130.892562,18.0006367 C130.875114,18.9689411 131.102483,19.9263452 131.554248,20.7868561 C131.969433,21.5861062 132.604753,22.2544276 133.38767,22.7155165 C134.210494,23.1780223 135.145478,23.412314 136.093002,23.3934288 C137.258162,23.443474 138.403231,23.0828904 139.322169,22.3765604 C139.629636,22.1288284 140.010627,21.9860775 140.407748,21.969813 C140.684003,21.971472 140.951884,22.0632701 141.169376,22.2308092 C141.506776,22.4760453 141.712267,22.8590536 141.727674,23.2714045 C141.726107,23.5657218 141.601472,23.8464365 141.383046,24.0476141 C139.948162,25.3550379 138.048099,26.0550733 136.093002,25.9966118 Z" id="Path" fill="#FFFFFF"/>
            <path d="M158.984853,17.7535016 C158.992698,18.0943929 158.855922,18.4227367 158.608238,18.6576086 C158.351185,18.8994749 158.007896,19.0287138 157.654823,19.0165425 L146.675288,19.0165425 C146.850095,20.2957295 147.506425,21.4604809 148.510865,22.2740369 C150.073435,23.4966893 152.150787,23.8447742 154.027776,23.1984609 C154.58241,23.0243086 155.104961,22.7612667 155.574954,22.4196421 C155.846731,22.2074712 156.183377,22.095081 156.528369,22.1013423 C156.843502,22.0841968 157.153205,22.1884374 157.393567,22.3925528 C157.710016,22.6216684 157.901834,22.9845192 157.912686,23.3745417 C157.912055,23.7218907 157.739295,24.0464375 157.451247,24.2414009 C156.717588,24.8011812 155.892174,25.2296782 155.011727,25.507828 C152.694133,26.3154818 150.144142,26.1228346 147.974782,24.9761995 C146.751107,24.3207854 145.735647,23.3366735 145.043287,22.1352039 C144.332116,20.8783774 143.972366,19.4539398 144.001656,18.0108504 C143.978343,16.5695736 144.321542,15.1459245 144.999179,13.8729522 C145.637172,12.6811906 146.597629,11.692144 147.771206,11.0184119 C149.000366,10.3280412 150.391794,9.97737105 151.802012,10.0025613 C153.14953,9.96682535 154.480475,10.3056393 155.646206,10.9811641 C156.723603,11.6335801 157.586772,12.5856454 158.129834,13.7205746 C158.727211,14.9824189 159.024468,16.3649197 158.998425,17.7602739 L158.984853,17.7535016 Z M151.805405,12.4744645 C150.559883,12.4197356 149.338838,12.8315753 148.381934,13.629148 C147.485929,14.4337723 146.898183,15.5243224 146.719396,16.7139478 L156.341758,16.7139478 C156.227835,15.5509153 155.717652,14.4620654 154.896368,13.629148 C154.064939,12.8428706 152.949803,12.426292 151.805405,12.4744645 L151.805405,12.4744645 Z" id="Shape" fill="#FFFFFF"/>
            <path d="M16.7349933,13.3823202 C15.1971106,13.3794424 13.8552566,14.4249125 13.4823072,15.9165648 C13.1093578,17.408217 13.8013418,18.9619737 15.159693,19.682908 C16.5180441,20.4038424 18.1930077,20.1063248 19.2198447,18.9617183 L28.7954459,18.9617183 C29.4578316,15.3790724 28.4935546,11.6874028 26.1636371,8.88601489 C23.8337196,6.084627 20.3791282,4.46324843 16.7349933,4.4607734 L16.7349933,0 C7.49251173,0 0,7.49087232 0,16.7313316 L4.46174966,16.7313316 C4.46302181,22.1629377 8.03585959,26.9474179 13.2442852,28.492254 C18.4527109,30.0370902 24.0572562,27.9746518 27.0210424,23.4224917 L20.7574323,23.4224917 C18.3449034,24.8713872 15.339317,24.9108085 12.8896008,23.5256863 C10.4398846,22.1405641 8.9247962,19.5450561 8.92349932,16.7313316 L4.46174966,16.7313316 C4.46174966,9.95448944 9.95666802,4.4607734 16.7349933,4.4607734 L16.7349933,8.9215468 C20.1889029,8.92412431 23.231873,11.1922521 24.2204364,14.5009449 L19.2198447,14.5009449 C18.5894012,13.7903338 17.6850709,13.3832244 16.7349933,13.3823202 Z" id="Path" fill="#00BEDA"/>
        </g>
    </g>
</svg></h2>
        <?php if ($ownerName) { ?>
                <h3>Hey, <?php echo $ownerName; ?></h3>
             <?php } ?>
             <p>Keep in mind this plugin needs <a href="https://woocommerce.com/products/woocommerce-subscriptions/" target="_blank"> WooCommerce subscriptions </a> & WooCommerce in order to work.</p>
            <p>You can display the SSO link by calling this shortcode: [fetch_sso_link]</p>
        <form method="post" action="options.php" style="margin-bottom: 24px;">
    <?php
    settings_fields("enhance_panel_group");
    do_settings_sections("enhance_panel_section");
    ?>           
                 <button type="submit" style="width: 100%; background-color: #2D3748; color: white; font-weight: bold; padding: 8px 16px; border-radius: 4px; outline: none; transition: background-color 0.3s; cursor: pointer;">Save Settings</button>
        </form>
        <form method="post" action="<?php echo esc_url(
            admin_url("admin-post.php")
        ); ?>" style="margin-bottom: 24px;">
            <input type="hidden" name="action" value="test_api_call">
            <button type="submit" style="width: 100%; background-color: #68D391; color: white; font-weight: bold; padding: 8px 16px; border-radius: 4px; outline: none; transition: background-color 0.3s; cursor: pointer;">Test API Call</button>
        </form>
    </div>
</div>


        <?php
    }

    public function register_settings()
    {
        register_setting("enhance_panel_group", "host");
        register_setting("enhance_panel_group", "apikey");
        register_setting("enhance_panel_group", "orgId");

        add_settings_section(
            "enhance_panel_section",
            "",
            [$this, "section_callback"],
            "enhance_panel_section"
        );

        $fields = [
            [
                "name" => "host",
                "type" => "text",
                "friendlyName" => "Hostname",
                "required" => true,
                "tooltip" => "The HostName of your organization like this https://domain.tld >>> NO / at end",
                "placeholder" => "e.g., https://example.com",
            ],
            [
                "name" => "apikey",
                "type" => "password",
                "friendlyName" => "API key",
                "required" => true,
                "tooltip" => "The Api Key of your organization.",
                "placeholder" => "My API Key",
            ],
            [
                "name" => "orgId",
                "type" => "text",
                "friendlyName" => "Organization ID",
                "required" => true,
                "tooltip" => "The ID of your organization.",
                "placeholder" => "My orgID Key",
            ],
        ];

        foreach ($fields as $field) {
            add_settings_field(
                $field["name"],
                $field["friendlyName"],
                [$this, "field_callback"],
                "enhance_panel_section",
                "enhance_panel_section",
                $field
            );
        }
    }

    public function section_callback()
    {
        echo "<p></p>";
    }

    public function field_callback($args)
    {
        $name = $args["name"];
        $type = $args["type"] ?? "text";
        $value = get_option($name);
        $required = $args["required"] ? "required" : "";
        $tooltipText =
            $args["tooltip"] ?? "No additional information available";
        $placeholder = $args["placeholder"] ?? "";

        echo '<div class="display: flex; 
position: relative; 
margin-bottom: 1rem; 
align-items: center; 
">';
        echo '<input type="' .
            esc_attr($type) .
            '" id="' .
            esc_attr($name) .
            '" name="' .
            esc_attr($name) .
            '" value="' .
            esc_attr($value) .
            '" placeholder="' .
            esc_attr($placeholder) .
            '" ' .
            $required .
            ' class="padding: 0.5rem; 
margin-right: 0.5rem; 
border-radius: 0.25rem; 
border-width: 1px; 
">';
        echo '<div class="display: flex; 
margin-left: 0.5rem; 
justify-content: center; 
align-items: center; 
border-radius: 9999px; 
color: #4B5563; 
background-color: #E5E7EB; 
cursor: pointer; 







" title="' .
            esc_attr($tooltipText) .
            '">';
        echo '<span class="text-sm">&#63;</span>';
        echo "</div>";
        echo "</div>";
    }

    private function make_api_call()
    {
        $host = get_option("host");
        $apikey = get_option("apikey");
        $orgId = get_option("orgId");

        $url = $host . "/api/orgs/" . $orgId;
        $headers = ["Authorization: Bearer " . $apikey];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return [$httpcode, $response];
    }

    public function test_api_call()
    {
        list($httpcode, $response) = $this->make_api_call();

        if ($httpcode == 200) {
            echo "API Call Successful";
        } else {
            echo "API Call Failed. HTTP Code: " . $httpcode;
        }

        exit();
    }

    public function get_name()
    {
        list($httpcode, $response) = $this->make_api_call();

        if ($httpcode == 200) {
            $data = json_decode($response, true);
            if (isset($data["owner"])) {
                return $data["owner"];
            } else {
                return "Owner information not found.";
            }
        } else {
            return "API Call Failed. HTTP Code: " . $httpcode;
        }
    }
    public function websitesCount()
    {
        list($httpcode, $response) = $this->make_api_call();

        if ($httpcode == 200) {
            $data = json_decode($response, true);
            if (isset($data["websitesCount"])) {
                return $data["websitesCount"]; // Return instead of echo
            } else {
                return "Owner information not found.";
            }
        } else {
            return "API Call Failed. HTTP Code: " . $httpcode;
        }
    }
}
