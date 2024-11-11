jQuery(window).load(function() {
    jQuery('#fs_slider .flexslider').flexslider({
        animation: 'slide',
            slideshowSpeed: 9000,
            animationSpeed: 900,
            pauseOnAction: true,
            pauseOnHover: true,
            controlNav: false,
            directionNav: true, 
            controlsContainer: ".flexslider",
    });
    

    jQuery('.updateSpecifications').on('click',function(){
        $(this).siblings('.updateSpecifications').removeClass('btn-outline-success active');
        $(this).addClass('btn-outline-success active');

        let data = JSON.parse($('.vol_freq_data_array').html());
        let activeVoltage = $('.spec_tab_btns .voltageBtn.active').data('value');
        let activeFreq = $('.spec_tab_btns .frequencyBtn.active').data('value');

        let url = $('.downloadPDFBtn').attr('data-base');
        url = url + '&voltage='+activeVoltage+'&freq='+activeFreq;
        
        $('.downloadPDFBtn').attr('href',url);
        
        if((data[activeVoltage][activeFreq] != undefined) && (data[activeVoltage][activeFreq]['short_specification'] != false)){
            let html = '';
            let specification = data[activeVoltage][activeFreq]['short_specification'];
            
            specification.forEach(function( val ) {
                html += '<div class="specRow"><h4 class="specLabel">'+ val.label +'</h4>';
                html += '<p class="specVal">'+ val.value +'</p></div>';              
            });
            $('.shortSpecificationContainer').html(html);
        }else{
            $('.shortSpecificationContainer').html('');
        }
        
    });

    //const currentTheme = localStorage.getItem('theme') || 'light';
    //jQuery('html').attr('data-theme', currentTheme);

    // jQuery('#theme-icon').attr(
    //     'class', 
    //     currentTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun'
    // );

    // Handle the button click event to toggle the theme
    jQuery('#theme-icon').on('click', function () {
        let newTheme = $('html').attr('data-theme') === 'light' ? 'dark' : 'light';

        // Apply the new theme
        $('html').attr('data-theme', newTheme );

        // Save the user's preference in localStorage
        localStorage.setItem('theme', newTheme );
        jQuery(this).attr('class', newTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun');
    });

    jQuery('.updateCurve').on('click',function(){
        $(this).siblings('.updateCurve').removeClass('btn-outline-success active');
        $(this).addClass('btn-outline-success active');

        let data = JSON.parse($('.curve_data_array').html());
        let activeVoltage = $('.curve_tab_btns .voltageBtn.active').data('value');
        let activeFreq = $('.curve_tab_btns .frequencyBtn.active').data('value');
        
        if((data[activeVoltage][activeFreq] != undefined) && (data[activeVoltage][activeFreq]['curve_data'] != false)){
            let curve_data = data[activeVoltage][activeFreq]['curve_data'];
            let finalData = [];
            curve_data.forEach(val => {
                finalData.push([parseInt(val.static_pressure), parseInt(val.air_volume)]);
            });
            
            jQuery('.activeHighchart_data_array').html(JSON.stringify(finalData));
            updateCurve();
        }else{
            $('.activeHighchart_data_array').html([]);
        }
        
    });
});

function updateCurve(){
    let data = $('.activeHighchart_data_array').html();
    let animation = $('.activeHighchart_data_array').data('animation');
    
    if(typeof data === 'string'){
        data = JSON.parse(data);
    }
    
    let title = jQuery('.product_outer_div .product-title').html();
    title = title.replace(' ','_');
    
    let activeVoltage = $('.curve_tab_btns .voltageBtn.active').data('value');
    let activeFreq = $('.curve_tab_btns .frequencyBtn.active').data('value');

    let chartTitle = title+'_'+activeVoltage+'V_'+activeFreq+'Hz';
    
    Highcharts.chart('container', {
        chart: {
            type: 'spline',
            inverted: true
        },
        title: {
            text: chartTitle,
            align: 'center'
        },
        subtitle: {
            text: chartTitle,
            align: 'center'
        },
        xAxis: {
            reversed: false,
            title: {
                enabled: true,
                text: 'Static Pressure (Pa)'
            },
            labels: {
                format: '{value}'
            },
            accessibility: {
                rangeDescription: 'Range: 0 to 100'
            },
            maxPadding: 0.05,
            showLastLabel: true,
            gridLineWidth: 1,
            lineWidth: 2,
            lineColor: '#ccd6eb'
        },
        yAxis: {
            title: {
                text: 'Air Volume (m³/h)'
            },
            labels: {
                format: '{value}'
            },
            accessibility: {
                rangeDescription: 'Range: 0 to 1200'
            },
            gridLineWidth: 1,
            lineWidth: 1,
            lineColor: '#ccd6eb'
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '',
            pointFormat: '{point.y} m³/h </br> {point.x} pa'
        },
        plotOptions: {
            spline: {
                marker: {
                    enable: false
                }
            }
        },
        series: [{
            name: 'Temperature',
            color: '#c12227',
            data: data,
            animation:animation,
            marker: {
                enabled: false, // Hide markers by default
                states: {
                    hover: {
                        enabled: true // Show markers on hover
                    }
                }
            }

        }]
    });
}