$(document).ready(function () {
    var $niceSelect1 = $('.ad-small-niceSelect'),
        $select2 = $('.ad-select2'),
        $taginput = $('.ad-tagsinput');


    // Screen Width
    let bodywidth = screen.width;

    // Nice Select
    if ($niceSelect1.length > 0) {
        $($niceSelect1).niceSelect();
    }

    $('.select-option').niceSelect();

    // Select 2
    if ($select2.length > 0) {
        $select = $(".ad-select2").select2({});
        $select.each(function () {
            if ($(this).data('select2')) {
                $(this).data('select2').$dropdown.addClass('select-drop');
            }
        });
    }


    // tagify
    if ($taginput.length > 0) {
        $($taginput).tagify({
            duplicates: false
        });
    }


    // Main Menu Language Select
    // $('.img-text-select .drop-content .drop-ul li').click(function (e) {
    //     e.preventDefault();
    //     var value = $(this).find('.select-text').text();
    //     var icon = $(this).find('.select-image').html();
    //     $('.selected-text').val(value);
    //     var item = icon + " " + value
    //     $('.selected-show').empty().append(item);
    // });
    // Language Select class add remove
    const langToggle = $(".selected-show");
    const langmenu = $(".drop-content");
    langToggle.on("click", function (event) {
        event.stopPropagation();
        langmenu.toggleClass("active");
        langToggle.toggleClass("active");
        // Notification
        notiWrap.removeClass("active");
        notiToggle.removeClass("active");
        // Profile
        profileMenu.removeClass("active");
        profileToggle.removeClass("active");
        // Search
        searchWrap.removeClass("active");
        searchToggle.removeClass("active");
    });
    $(document).on("click", function (event) {
        const target = $(event.target);
        if (!langToggle.is(target) && !langmenu.is(target)) {
            langmenu.removeClass("active");
            langToggle.removeClass("active");
        }
    });


    // Profile Dropdown Toggle
    const profileContainer = $(".header-dropdown-md");
    const profileToggle = $(".header-dropdown-toggle-md");
    const profileMenu = $(".header-dorpdown-menu-md");
    if (profileToggle.length) {
        profileToggle.on("click", function (event) {
            event.stopPropagation();
            profileMenu.toggleClass("active");
            profileToggle.toggleClass("active");
            // Notification
            notiWrap.removeClass("active");
            notiToggle.removeClass("active");
            // Language
            langmenu.removeClass("active");
            langToggle.removeClass("active");
            // Search
            searchWrap.removeClass("active");
            searchToggle.removeClass("active");
        });
    }
    $(document).on("click", function (event) {
        const target = $(event.target);
        if (profileContainer.length && !profileContainer.is(target) && !profileContainer.has(target).length) {
            profileMenu.removeClass("active");
            if (profileToggle.length) {
                profileToggle.removeClass("active");
            }
        }
    });


    // Sidebar Toggle
    const sideToggle = $(".menu-toggler");
    const sideMenu = $(".ad-sidebar");
    if (sideToggle.length) {
        sideToggle.on("click", function (event) {
            event.stopPropagation();
            sideMenu.toggleClass("hide");
            sideToggle.toggleClass("active");
        });
    }


    // Mobile Search Toggle
    const searchContainer = $(".header-mobile-search");
    const searchToggle = $(".mobile-search-label");
    const searchWrap = $(".mobile-search");
    if (searchToggle.length) {
        searchToggle.on("click", function (event) {
            event.stopPropagation();
            searchWrap.toggleClass("active");
            searchToggle.toggleClass("active");
            // Notification
            notiWrap.removeClass("active");
            notiToggle.removeClass("active");
            // Language
            langmenu.removeClass("active");
            langToggle.removeClass("active");
            // Profile
            profileMenu.removeClass("active");
            profileToggle.removeClass("active");
            // focus
            setTimeout(function () {
                $('.mobile-search-inner .form-control').focus();
            }, 100);
        });
    }
    $(document).on("click", function (event) {
        const target = $(event.target);
        if (searchContainer.length && !searchContainer.is(target) && !searchContainer.has(target).length) {
            searchWrap.removeClass("active");
            if (searchToggle.length) {
                searchToggle.removeClass("active");
            }
        }
    });


    // Notification Toggle
    const notiContainer = $(".header-dropdown-lg");
    const notiToggle = $(".header-dropdown-toggle-lg");
    const notiWrap = $(".header-dropdown-menu-lg");
    if (notiToggle.length) {
        notiToggle.on("click", function (event) {
            event.stopPropagation();
            notiWrap.toggleClass("active");
            notiToggle.toggleClass("active");
            // Search
            searchWrap.removeClass("active");
            searchToggle.removeClass("active");
            // Language
            langmenu.removeClass("active");
            langToggle.removeClass("active");
            // Profile
            profileMenu.removeClass("active");
            profileToggle.removeClass("active");
        });
    }
    $(document).on("click", function (event) {
        const target = $(event.target);
        if (notiContainer.length && !notiContainer.is(target) && !notiContainer.has(target).length) {
            notiWrap.removeClass("active");
            if (notiToggle.length) {
                notiToggle.removeClass("active");
            }
        }
    });


    // Sidebar First Sub-Menu Toggle
    $(".first-li-have-sub > a").on("click", function () {
        if ($(".ad-sidebar").hasClass('hide')) {
            if (bodywidth < 992) {
                $(this).siblings(".first-sub-menu").slideToggle();
                $(".first-sub-menu").not($(this).siblings()).slideUp();
                $(this).parent().toggleClass("active");
                $(".first-li-have-sub").not($(this).parent()).removeClass("active");
            }
        } else {
            if (bodywidth > 991) {
                $(this).siblings(".first-sub-menu").slideToggle();
                $(".first-sub-menu").not($(this).siblings()).slideUp();
                $(this).parent().toggleClass("active");
                $(".first-li-have-sub").not($(this).parent()).removeClass("active");
            }
        }
    });

    // Sidebar second submenu
    $(".second-li-have-sub > a").on("click", function () {
        $(this).parent().toggleClass("active");
        $(".second-li-have-sub").not($(this).parent()).removeClass("active");
        $(this).siblings(".second-sub-menu").slideToggle();
        $(".second-sub-menu").not($(this).siblings()).slideUp();
    });



    // user profile submenu
    $(".dropdown-list-have-sub > a").on("click", function () {
        $(this).parent().toggleClass("active");
        $(this).siblings(".dropdown-list-submenu").slideToggle();
        $(".dropdown-list-have-sub").not($(this).parent()).removeClass("active");
        $(".dropdown-list-submenu").not($(this).siblings()).slideUp();
    });

    // hidden-search-input
    $(".search-element").on("click", function () {
        $('.hidden-search-input .form-control').toggleClass('active');
    });





});


// theme change
var themeChangeBtn = document.getElementById("themeChangeBtn");
themeChangeBtn.onclick = function () {
    document.body.classList.toggle("dark-mood");
}


// rich-alert close
$(document).ready(function () {
    $('.rich-alert-close').on('click', function () {
        $('.rich-alert').hide();
    });
});

// toaster close
$(document).ready(function () {
    $('.toaster-close').on('click', function () {
        $('.toaster1').hide();
    });
});

$(document).ready(function () {
    $('.toaster-close2').on('click', function () {
        $('.toaster2').hide();
    });
});




// Progressbar

$(function () {
    const generateWidth = (index) => {
        const baseWidths = ["50%", "60%", "70%", "80%"];
        if (index === 21) return "90%";
        return baseWidths[(index - 1) % baseWidths.length];
    };

    for (let i = 1; i <= 21; i++) {
        const width = generateWidth(i);
        $("#progress-bar" + i).animate({
            width: width
        }, 3000);
    }
});




$(function () {
    // Array of button classes and their final texts
    var buttons = [
        { class: 'PrimaryLoading', text: 'Primary' },
        { class: 'SuccessLoading', text: 'Success' },
        { class: 'WarningLoading', text: 'Warning' },
        { class: 'DangerLoading', text: 'Danger' },
        { class: 'InfoLoading', text: 'Info' },
        { class: 'SecondaryLoading', text: 'Secondary' }
    ];

    // Initialize loading buttons
    buttons.forEach(function (button) {
        var element = document.querySelector('.' + button.class);
        if (element) {
            element.addEventListener("click", function () {
                handleLoadingState(element, button.text);
            }, false);
        }
    });

    // Function to handle loading state
    function handleLoadingState(element, finalText) {
        element.innerHTML = "Please wait...";
        element.classList.add('spinning');

        setTimeout(function () {
            element.classList.remove('spinning');
            element.innerHTML = finalText;
        }, 3000);
    }
});





// tooltip js

$(function () {

    $('.placement-top').tooltip({
        'placement': 'top',
    });

    $('#placement-bottom').tooltip({
        'placement': 'bottom',
    });

    $('#placement-right').tooltip({
        'placement': 'right',
    });

    $('#placement-left').tooltip({
        'placement': 'left',
    });

})




//  Tooltip
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl, {
        trigger: 'hover'
    });
});


// Dashboard Accordion
function accordion() {
    var Accordion = function (el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        // Variables privadas
        var links = this.el.find('.accordion-btn-wrap');
        // Evento
        links.on('click', { el: this.el, multiple: this.multiple }, this.dropdown)
    }
    Accordion.prototype.dropdown = function (e) {
        var $el = e.data.el,
            $this = $(this),
            $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('active-accor');
        if (!e.data.multiple) {
            $el.find('.accoritem-body').not($next).slideUp().parent().removeClass('active-accor');
            $el.find('.accoritem-body').not($next).slideUp();
        };
    }
    var accordion = new Accordion($('.ad-my-accordion'), false);
}
accordion();
// Dashboard Accordion













/************************************/
//summernote editor
/************************************/
$("#summernote").summernote({
    height: 120,
    minHeight: null,
    maxHeight: null,
    focus: false,
});





$(document).ready(function () {
    for (let i = 2; i <= 6; i++) {
        const elem = '#tagsinput-id-' + i;
        initTagify(elem);
    }

    function initTagify(element) {
        if ($(element).length > 0) {
            $(element).tagify({
                duplicates: false
            });
        }
    }
});






// Area chart
var options = {
    series: [{
        name: 'purpleChart',
        data: [0, 170, 150, 200, 250, 350, 470]
    }, {
        name: 'primaryChart',
        data: [500, 140, 200, 180, 300, 200, 50]
    }],
    chart: {
        height: 295,
        type: 'area'
    },
    colors: ["#0095ff49", "#884dff79"],
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    grid: {
        strokeDashArray: 3,
        xaxis: {
            lines: {
                show: false,
            },
        },
    },
    xaxis: {
        type: 'day',
        categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"]
    },
};

let salesChart = document.querySelector("#selesChart");
if (salesChart) {
    var chart = new ApexCharts(document.querySelector("#selesChart"), options);
    chart.render();
}



// User chart
var options = {
    series: [
        {
            name: '',
            data: [
                {
                    x: '',
                    y: 500,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,
                        }
                    ]
                },
                {
                    x: '',
                    y: 450,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,
                        }
                    ]
                },
                {
                    x: '',
                    y: 150,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,
                        }
                    ]
                },
                {
                    x: '',
                    y: 300,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,
                        }
                    ]
                },
                {
                    x: '',
                    y: 500,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,
                        }
                    ]
                },
                {
                    x: '',
                    y: 400,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,
                        }
                    ]
                },
                {
                    x: '',
                    y: 450,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,

                        }
                    ]
                },
                {
                    x: '',
                    y: 200,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,

                        }
                    ]
                },
                {
                    x: '',
                    y: 150,
                    goals: [
                        {
                            name: 'User',
                            value: 500,
                            strokeWidth: 0,

                        }
                    ]
                }
            ]
        }
    ],
    chart: {
        height: 202,
        type: 'bar',
    },
    plotOptions: {
        bar: {
            borderRadius: 8,
        }
    },
    dataLabels: {
        enabled: false
    },
    grid: {
        show: false
    }

};

let userChart = document.querySelector("#userChart");
if (userChart) {
    var chart = new ApexCharts(document.querySelector("#userChart"), options);
    chart.render();
}





// =====================================
// pie1
// =====================================
var pie1 = {
    series: [25, 40, 35],
    labels: ['System', 'Your Files', 'Total admin'],
    chart: {
        width: 240,
        type: "donut",
    },
    plotOptions: {
        pie: {
            startAngle: 0,
            endAngle: 360,
            donut: {
                size: '75%',
            },
        },
    },
    stroke: {
        show: false,
    },

    dataLabels: {
        enabled: false,
    },

    legend: {
        show: false,
    },
    colors: [
        "#f6c000",
        "#7239ea",
        "#F4EFFD",
    ],

    responsive: [
        {
            breakpoint: 991,
            options: {
                chart: {
                    width: 200,
                },
            },
        },
    ],
    tooltip: {
        theme: "dark",
        fillSeriesColor: false,
    },
};

let pie = document.querySelector("#pie1");
if (pie) {
    var chart = new ApexCharts(document.querySelector("#pie1"), pie1);
    chart.render();
}
