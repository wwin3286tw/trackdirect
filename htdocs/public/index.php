<?php require "../includes/bootstrap.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo getWebsiteConfig('title'); ?></title>

        <!-- Mobile meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes">

        <!-- JS libs used by this website (not a dependency for the track direct js lib) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.5/mobile-detect.min.js" integrity="sha512-1vJtouuOb2tPm+Jh7EnT2VeiCoWv0d7UQ8SGl/2CoOU+bkxhxSX4gDjmdjmbX4OjbsbCBN+Gytj4RGrjV3BLkQ==" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//www.gstatic.com/charts/loader.js"></script>

        <!-- Stylesheets used by this website (not a dependency for the track direct js lib) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

        <!-- Track Direct js dependencies -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" integrity="sha512-jGsMH83oKe9asCpkOVkBnUrDDTp8wl+adkB2D+//JtlxO4SrLoJdhbOysIFQJloQFD+C4Fl1rMsQZF76JjV0eQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/autolinker/3.14.2/Autolinker.min.js" integrity="sha512-qyoXjTIJ69k6Ik7CxNVKFAsAibo8vW/s3WV3mBzvXz6Gq0yGup/UsdZBDqFwkRuevQaF2g7qhD3E4Fs+OwS4hw==" crossorigin="anonymous"></script>
        <script src="/js/convex-hull.js" crossorigin="anonymous"></script>

        <!-- Map api javascripts and related dependencies -->
        <?php $mapapi = $_GET['mapapi'] ?? 'leaflet'; ?>
        <?php if ($mapapi == 'google') : ?>
            <?php if (getWebsiteConfig('google_key') != null) : ?>
                <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php echo getWebsiteConfig('google_key'); ?>&libraries=visualization,geometry"></script>
            <?php else : ?>
                <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=visualization,geometry"></script>
            <?php endif; ?>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js" integrity="sha512-/3oZy+rGpR6XGen3u37AEGv+inHpohYcJupz421+PcvNWHq2ujx0s1QcVYEiSHVt/SkHPHOlMFn5WDBb/YbE+g==" crossorigin="anonymous"></script>

        <?php elseif ($mapapi == 'leaflet' || $mapapi == 'leaflet-vector'): ?>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" integrity="sha512-h9FcoyWjHcOcmEVkxOfTLnmZFWIH0iZhZT1H2TbOq55xssQGEJHEaIm+PgoUaZbRvQTNTluNOEfb1ZRy6D3BOw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" integrity="sha512-puJW3E/qXDqYp9IfhAI54BJEaWIfloJ7JWs7OeD5i6ruC9JZL1gERT1wjtwXFlh7CjE7ZJ+/vcRZRkIYIb6p4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <?php if ($mapapi == 'leaflet-vector'): ?>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.13.1/mapbox-gl.min.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.13.1/mapbox-gl.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl-leaflet/0.0.15/leaflet-mapbox-gl.min.js"></script>
            <?php endif; ?>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.11.0/leaflet-providers.min.js" integrity="sha512-TO+Wd5hbpDsACTmvzSqAZL83jMQCXGRFNoS4WZxcxrlJBTdgMYaT7g5uX49C5+Kbuxzlg2A+TFJ6UqdsXuOKLw==" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js" integrity="sha512-KhIBJeCI4oTEeqOmRi2gDJ7m+JARImhUYgXWiOTIp9qqySpFUAJs09erGKem4E5IPuxxSTjavuurvBitBmwE0w==" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier-Leaflet/0.2.6/oms.min.js" integrity="sha512-V8RRDnS4BZXrat3GIpnWx+XNYBHQGdK6nKOzMpX4R0hz9SPWt7fltGmmyGzUkVFZUQODO1rE+SWYJJkw3SYMhg==" crossorigin="anonymous"></script>
        <?php endif; ?>

        <!-- Track Direct jslib -->
        <script type="text/javascript" src="/js/trackdirect.min.js"></script>


        <script type="text/javascript" src="/js/main.js"></script>
        <link rel="stylesheet" href="/css/main.css">

        <script>
            $(document).ready(function() {
                google.charts.load('current', {'packages':['corechart', 'timeline']});

                var options = {};
                options['isMobile'] = false;
                options['useImperialUnit'] = <?php echo (isImperialUnitUser() ? 'true': 'false'); ?>;
                options['coverageDataUrl'] = '/data/coverage.php';
                options['coveragePercentile'] = <?php echo (getWebsiteConfig('coverage_percentile') ?? "95"); ?>;

                var md = new MobileDetect(window.navigator.userAgent);
                if (md.mobile() !== null) {
                    options['isMobile'] = true;
                }

                options['time'] =       "<?php echo $_GET['time'] ?? '' ?>";        // How many minutes of history to show
                options['center'] =     "<?php echo $_GET['center'] ?? '' ?>";      // Position to center on (for example "46.52108,14.63379")
                options['zoom'] =       "<?php echo $_GET['zoom'] ?? '' ?>";        // Zoom level
                options['timetravel'] = "<?php echo $_GET['timetravel'] ?? '' ?>";  // Unix timestamp to travel to
                options['maptype'] =    "<?php echo $_GET['maptype'] ?? '' ?>";     // May be "roadmap", "terrain" or "satellite"
                options['mid'] =        "<?php echo $_GET['mid'] ?? '' ?>";         // Render map from "Google My Maps" (requires https)

                options['filters'] = {};
                options['filters']['sid'] = "<?php echo $_GET['sid'] ?? '' ?>";         // Station id to filter on
                options['filters']['sname'] = "<?php echo $_GET['sname'] ?? '' ?>";     // Station name to filter on
                options['filters']['sidlist'] = "<?php echo $_GET['sidlist'] ?? '' ?>";     // Station id list to filter on (colon separated)
                options['filters']['snamelist'] = "<?php echo $_GET['snamelist'] ?? '' ?>"; // Station name list to filter on (colon separated)

                // Tell jslib which html element to use to show connection status and mouse coordinates
                options['statusContainerElementId'] = 'status-container';
                options['coordinatesContainerElementId'] = 'coordinate-container';

                <?php if (isSourceIdUsed(5)) : ?>
                    // Adapt settings for OGN data
                    options['symbolsToScale'] = [[88,47],[94,null]];
                    options['defaultMinZoomForMarkerTail'] = 11;
                    options['defaultMinZoomForMarkers'] = 9;
                    options['defaultTimeLength'] = 10;
                <?php else : ?>
                    options['defaultTimeLength'] = 60; // In minutes
                <?php endif; ?>

                // Set this setting to false if you want to stop animations
                options['animate'] = true;

                // Use Stockholm as default position (will be used if we fail to fetch location from ip-location service)
                options['defaultLatitude'] = '59.30928';
                options['defaultLongitude'] = '18.08830';

                // Tip: request position from some ip->location service (https://freegeoip.app/json and https://ipapi.co/json is two examples)
                $.getJSON('https://ipapi.co/json', function(data) {
                    if (data.latitude && data.longitude) {
                        options['defaultLatitude'] = data.latitude;
                        options['defaultLongitude'] = data.longitude;
                    }
                }).fail(function() {
                    console.log('Failed to fetch location, using default location');
                }).always(function() {
                    <?php if ($mapapi == 'leaflet-vector') : ?>
                        options['mapboxGLStyle'] = "https://api.maptiler.com/maps/bright/style.json?optimize=true&key=<?php echo getWebsiteConfig('maptiler_key'); ?>";
                        options['mapboxGLAttribution'] = 'Map &copy; <a href="https://www.maptiler.com">MapTiler</a>, OpenStreetMap contributors';
                    <?php endif; ?>

                    <?php if ($mapapi == 'leaflet') : ?>
                        // We are using Leaflet -- read about leaflet-providers and select your favorite maps
                        // https://leaflet-extras.github.io/leaflet-providers/preview/

                        // Make sure to read the license requirements for each provider before launching a public website
                        // https://wiki.openstreetmap.org/wiki/Tile_servers

                        // Many providers require a map api key or similar, the following is an example for HERE
                        L.TileLayer.Provider.providers['HERE'].options['app_id'] = '<?php echo getWebsiteConfig('here_app_id'); ?>';
                        L.TileLayer.Provider.providers['HERE'].options['app_code'] = '<?php echo getWebsiteConfig('here_app_code'); ?>';

                        options['supportedMapTypes'] = {};
                        options['supportedMapTypes']['roadmap'] = "<?php echo getWebsiteConfig('leaflet_raster_tile_roadmap'); ?>";
                        options['supportedMapTypes']['terrain'] = "<?php echo getWebsiteConfig('leaflet_raster_tile_terrain'); ?>";
                        options['supportedMapTypes']['satellite'] = "<?php echo getWebsiteConfig('leaflet_raster_tile_satellite'); ?>";
                    <?php endif; ?>

                    // host is used to create url to /heatmaps and /images (leave empty to use same host as website)
                    options['host'] = "";
                    var supportsWebSockets = 'WebSocket' in window || 'MozWebSocket' in window;
                    if (supportsWebSockets) {
                        <?php if (getWebsiteConfig('websocket_url') != null) : ?>
                             var wsServerUrl = "<?php echo getWebsiteConfig('websocket_url'); ?>";
                        <?php else : ?>
                            var wsServerUrl = '';
                            if (window.location.protocol == 'https:') {
                                wsServerUrl += 'wss://' + window.location.host;
                            } else {
                                wsServerUrl += 'ws://' + window.location.host;
                            }
                            wsServerUrl += '/ws';
                        <?php endif; ?>
                        var mapElementId = 'map-container';

                        trackdirect.init(wsServerUrl, mapElementId, options);
                    } else {
                        alert('This service require HTML 5 features to be able to feed you APRS data in real-time. Please upgrade your browser.');
                    }

                    $('#station-search').keypress(function (e) {
                        if (e.which == 13) {
                            var q = $('#station-search').val();
                            loadView('/views/search.php?imperialUnits=<?php echo $_GET['imperialUnits'] ?? '0'; ?>&q=' + q + '&seconds=0');
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="topnav" id="tdTopnav">
            <a  style="color: white; padding: 7px 10px 8px 10px;"
                href=""
                onclick="
                    if (location.protocol != 'https:') {
                        trackdirect.setCenter(); // Will go to default position
                    } else {
                        trackdirect.setMapLocationByGeoLocation(
                            function(errorMsg) {
                                var msg = 'We failed to determine your current location by using HTML 5 Geolocation functionality';
                                if (typeof errorMsg !== 'undefined' && errorMsg != '') {
                                    msg += ' (' + errorMsg + ')';
                                }
                                msg += '.';
                                alert(msg);
                            },
                            function() {},
                            5000
                        );
                    }
                    return false;"
                title="Go to my current position">
                <img src="images/mylocation.png" width="25px" height="25px" style="width: 25px; padding: 0px;">
            </a>

            <div class="dropdown">
                <button class="dropbtn">軌跡長度
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="tdTopnavTimelength">
                    <?php if (isSourceIdUsed(5)) : ?>
                    <a href="javascript:void(0);" id="tdTopnavTimelengthDefault" onclick="trackdirect.setTimeLength(10); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">10 分鐘</a>
                    <? else : ?>
                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(10); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">10 分鐘</a>
                    <?php endif; ?>

                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(30); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">30 分鐘</a>

                    <?php if (isSourceIdUsed(5)) : ?>
                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(60); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">1 小時</a>
                    <?php else : ?>
                    <a href="javascript:void(0);" id="tdTopnavTimelengthDefault" onclick="trackdirect.setTimeLength(60); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">1 小時</a>
                    <?php endif; ?>

                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(180); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">3 小時</a>
                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(360); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">6 小時</a>
                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(720); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox dropdown-content-checkbox-only-filtering">12 小時</a>
                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(1080); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox dropdown-content-checkbox-only-filtering">18 小時</a>
                    <a href="javascript:void(0);" onclick="trackdirect.setTimeLength(1440); $('#tdTopnavTimelength>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox dropdown-content-checkbox-only-filtering">24 小時</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">地圖 API
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <?php if (getWebsiteConfig('google_key') != null) : ?>
                        <a href="/?mapapi=google" title="Switch to Google Maps" <?= ($mapapi=="google"?"class='dropdown-content-checkbox dropdown-content-checkbox-active'":"class='dropdown-content-checkbox'") ?> >Google Maps API</a>
                    <?php endif; ?>
                    <a href="/?mapapi=leaflet" title="Switch to Leaflet with raster tiles" <?= ($mapapi=="leaflet"?"class='dropdown-content-checkbox  dropdown-content-checkbox-active'":"class='dropdown-content-checkbox'") ?> >Leaflet - Raster Tiles</a>
                    <?php if (getWebsiteConfig('maptiler_key') != null) : ?>
                        <a href="/?mapapi=leaflet-vector" title="Switch to Leaflet with vector tiles" <?= ($mapapi=="leaflet-vector"?"class='dropdown-content-checkbox dropdown-content-checkbox-active'":"class='dropdown-content-checkbox'") ?> >Leaflet - Vector Tiles</a>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($mapapi != 'leaflet-vector') : ?>
            <div class="dropdown">
                <button class="dropbtn">地圖類型
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="tdTopnavMapType">
                    <a href="javascript:void(0);" onclick="trackdirect.setMapType('roadmap'); $('#tdTopnavMapType>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox dropdown-content-checkbox-active">路網圖</a>
                    <a href="javascript:void(0);" onclick="trackdirect.setMapType('terrain'); $('#tdTopnavMapType>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">地形/戶外</a>
                    <?php if ($mapapi == 'google' || getWebsiteConfig('leaflet_raster_tile_satellite') != null) : ?>
                    <a href="javascript:void(0);" onclick="trackdirect.setMapType('satellite'); $('#tdTopnavMapType>a').removeClass('dropdown-content-checkbox-active'); $(this).addClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox">衛星</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="dropdown">
                <button class="dropbtn">設定
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="tdTopnavSettings">
                    <a href="javascript:void(0);" onclick="trackdirect.toggleImperialUnits(); $(this).toggleClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox <?php echo (isImperialUnitUser()?'dropdown-content-checkbox-active':''); ?>" title="Switch to imperial units">使用英制單位</a>
                    <a href="javascript:void(0);" onclick="trackdirect.toggleStationaryPositions(); $(this).toggleClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox" title="Hide stations that is not moving">隱藏不移動的站台</a>

                    <?php if (isSourceIdUsed(1)) : ?>
                    <a href="javascript:void(0);" onclick="trackdirect.toggleInternetPositions(); $(this).toggleClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox" title="Hide stations that sends packet using TCP/UDP">隱藏網路站台</a>
                    <?php endif; ?>

                    <?php if (isSourceIdUsed(2)) : ?>
                    <a href="javascript:void(0);" onclick="trackdirect.toggleCwopPositions(); $(this).toggleClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox" title="Hide CWOP weather stations">隱藏公民氣象觀察員計劃站台</a>
                    <?php endif; ?>

                    <?php if (isSourceIdUsed(5)) : ?>
                    <a href="javascript:void(0);" onclick="trackdirect.toggleOgflymPositions(); $(this).toggleClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox" title="Hide model airplanes (OGFLYM)">Hide model airplanes (OGFLYM)</a>
                    <a href="javascript:void(0);" onclick="trackdirect.toggleUnknownPositions(); $(this).toggleClass('dropdown-content-checkbox-active');" class="dropdown-content-checkbox" title="Hide unknown aircrafts">Hide unknown aircrafts</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">其他
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">

                    <a href="/views/search.php"
                        class="tdlink"
                        onclick="$(this).attr('href', '/views/search.php?imperialUnits=' + (trackdirect.isImperialUnits()?'1':'0'))"
                        title="Search for a station/vehicle here!">
                        站台搜尋
                    </a>

                    <a href="/views/latest.php"
                        class="tdlink"
                        onclick="$(this).attr('href', '/views/latest.php?imperialUnits=' + (trackdirect.isImperialUnits()?'1':'0'))"
                        title="List latest heard stations!">
                        最新聽到
                    </a>

                    <?php if (isAllowedToShowOlderData()) : ?>
                    <a href="javascript:void(0);"
                        onclick="$('#modal-timetravel').show();"
                        title="Select date and time to show what the map looked like then">
                        時光旅行
                    </a>
                    <?php endif; ?>


                    <?php if (isSourceIdUsed(1)) : ?>
                    <a class="triple-notselected" href="#" onclick="trackdirect.togglePHGCircles(); return false;" title="Show PHG cirlces, first click will show half PGH circles and second click will show full PHG circles.">
                        顯示/隱藏 PHG 傳輸範圍
                    </a>
                    <?php endif; ?>

                    <a href="/views/about.php" class="tdlink" title="More about this website">
                        關於
                    </a>
                </div>
            </div>

            <input type="text" id="station-search" placeholder="Search..">

            <a href="javascript:void(0);" class="icon" onclick="toggleTopNav()">&#9776;</a>
        </div>

        <div id="map-container"></div>

        <div id="right-container">
            <div id="right-container-filtered">
                <span id="right-container-filtered-content"></span>
                <a href="#" onclick="trackdirect.filterOnStationId([]); return false;">reset</a>
            </div>

            <div id="right-container-timetravel">
                <span id="right-container-timetravel-content"></span>
                <a href="#" onclick="trackdirect.setTimeTravelTimestamp(0); $('#right-container-timetravel').hide(); return false;">reset</a>
            </div>
        </div>

        <div id="td-modal" class="modal">
            <div class="modal-long-content">
                <div class="modal-content-header">
                    <span class="modal-close" id="td-modal-close">&times;</span>
                    <span class="modal-title" id="td-modal-title"><?php echo getWebsiteConfig('title'); ?></h2>
                </div>
                <div class="modal-content-body">
                    <div id="td-modal-content">
                        <?php $view = getView($_GET['view']); ?>
                        <?php if ($view) : ?>
                            <?php include($view); ?>
                        <?php else: ?>
                            <div id="td-modal-content-nojs">
                                <?php include(ROOT . '/public/views/about.php'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-timetravel" class="modal">
            <div class="modal-content">
                <div class="modal-content-header">
                    <span class="modal-close" onclick="$('#modal-timetravel').hide();">&times;</span>
                    <span class="modal-title">時光旅行</h2>
                </div>
                <div class="modal-content-body" style="margin: 0px 20px 20px 20px;">
                    <?php if (!isAllowedToShowOlderData()) : ?>
                        <div style="text-align: center;">
                            <p style="max-width: 800px; display: inline-block; color: red;">
                                The time travel feature that allows you to see the map as it looked like an earlier date is disabled on this website.
                            </p>
                        </div>
                    <?php else : ?>
                            <p>選擇顯示地圖資料的日期和時間（輸入您所在地區時區的時間）。常規時間長度選擇框仍可用於選擇應顯示多長時間的資料（相對於選定的日期和時間）。 </p>
                            <p>*請注意，熱圖仍將基於最近一小時的資料（而不是選定的日期和時間）。 </p>
                            <p>日期和時間：</p>
                        <form id="timetravel-form">
                            <select id="timetravel-date" class="timetravel-select form-control"
                                <option value="0" selected>Select date</option>
                                <?php for($i=0; $i <= 10; $i++) : ?>
                                    <?php $date = date('Y-m-d', strtotime("-$i days")); ?>
                                    <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
                                <?php endfor; ?>
                            </select>

                            <select id="timetravel-time" class="timetravel-select form-control">
                                <option value="0" selected>Select time</option>
                                <option value="00:00">00:00</option>
                                <option value="01:00">01:00</option>
                                <option value="02:00">02:00</option>
                                <option value="03:00">03:00</option>
                                <option value="04:00">04:00</option>
                                <option value="05:00">05:00</option>
                                <option value="06:00">06:00</option>
                                <option value="07:00">07:00</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                                <option value="23:00">23:00</option>
                            </select>
                            <input type="submit"
                                value="Ok"
                                onclick="
                                    if ($('#timetravel-date').val() != '0' && $('#timetravel-time').val() != '0') {
                                        trackdirect.setTimeLength(60, false);
                                        var ts = moment($('#timetravel-date').val() + ' ' + $('#timetravel-time').val(), 'YYYY-MM-DD HH:mm').unix();
                                        trackdirect.setTimeTravelTimestamp(ts);
                                        $('#right-container-timetravel-content').html('Time travel to ' + $('#timetravel-date').val() + ' ' + $('#timetravel-time').val());
                                        $('#right-container-timetravel').show();
                                    } else {
                                        trackdirect.setTimeTravelTimestamp(0, true);
                                        $('#right-container-timetravel').hide();
                                    }
                                    $('#modal-timetravel').hide();
                                    return false;"/>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div id="bottominfo-container">
            <div style="margin-left: 10px; width: 350px;">
                <span id="status-container"></span>
            </div>
            <div style="width: 350px;">
                <span id="maintainer-container">Maintained by <a href="mailto:<?php echo getWebsiteConfig('owner_email'); ?>"><?php echo getWebsiteConfig('owner_name'); ?></a>, based on <a target="_blank" href="https://www.aprsdirect.com">APRS Track Direct</a></span>
            </div>
            <div style="margin-right:10px; width: 350px; text-align:right;">
                <span id="coordinate-container"></span>
            </div>
        </div>
    </body>
</html>
