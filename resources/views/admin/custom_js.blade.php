<script>
    if ($(".ui.selection.dropdown")) {
        $(".ui.selection.dropdown").click(function() {
            $(".ui-search-icon").addClass('hidden');
        });
    }
</script>


<script>
    /************************************/
    //summernote editor
    /************************************/
    $("#summernote").summernote({
        height: 120,
        minHeight: null,
        maxHeight: null,
        focus: false,
    });
</script>

<script>
    // Datepicker
    $(document).ready(function() {
        $(".datepicker-autoclose").datepicker({
            autoclose: true,
            todayHighlight: true,
        });
    });

    // daterangepicker
    $(function() {
        $('#basic').daterangepicker();
    });


    // fullcalender

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            height: 'parent',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            defaultView: 'dayGridMonth',
            defaultDate: '2023-02-12',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [{
                    title: 'All Day Event',
                    start: '2023-02-01',
                },
                {
                    title: 'Long Event',
                    start: '2023-02-07',
                    end: '2023-02-10'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-02-09T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-02-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2023-02-11',
                    end: '2023-02-13'
                },
                {
                    title: 'Meeting',
                    start: '2023-02-12T10:30:00',
                    end: '2023-02-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2023-02-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2023-02-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2023-02-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2023-02-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2023-02-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2023-02-28'
                }
            ]
        });

        calendar.render();
    });
</script>

<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const progressBar = document.getElementById('progressBar');

    document.getElementById('nextBtn1').addEventListener('click', () => {
        changeStep(1);
    });
    document.getElementById('prevBtn1').addEventListener('click', () => {
        changeStep(-1);
    });
    document.getElementById('nextBtn2').addEventListener('click', () => {
        changeStep(1);
    });
    document.getElementById('prevBtn2').addEventListener('click', () => {
        changeStep(-1);
    });

    function showStep(step) {
        steps.forEach((stepElement, index) => {
            stepElement.classList.toggle('active', index === step);
        });
        progressSteps.forEach((progressStep, index) => {
            progressStep.classList.toggle('active', index <= step);
        });
        progressBar.style.width = ((step) / (steps.length - 1)) * 100 + '%';
    }

    function changeStep(stepChange) {
        currentStep += stepChange;
        if (currentStep < 0) {
            currentStep = 0;
        } else if (currentStep >= steps.length) {
            currentStep = steps.length - 1;
        }
        showStep(currentStep);
    }
    showStep(currentStep);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vertical_next1 = document.getElementById('vertical-next1');
        const vertical_next2 = document.getElementById('vertical-next2');
        const vertical_prev1 = document.getElementById('vertical-prev1');
        const vertical_prev2 = document.getElementById('vertical-prev2');

        const formSteps = document.querySelectorAll('.vertical-form-step');
        const steps = document.querySelectorAll('.vertical-step');
        const line = document.querySelector('.vertical-line');
        let currentStep = 0;

        vertical_next1.addEventListener('click', function() {
            steps[currentStep].classList.add('active');
            formSteps[currentStep].querySelector('button').classList.add('hidden');
            currentStep++;
            steps[currentStep].classList.add('active');
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.remove(
                'hidden'));
            updateFormSteps();
            updateProgressBar();
        });

        vertical_next2.addEventListener('click', function() {
            steps[currentStep].classList.add('active');
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.add(
                'hidden'));
            currentStep++;
            steps[currentStep].classList.add('active');
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.remove(
                'hidden'));
            updateFormSteps();
            updateProgressBar();
        });

        vertical_prev1.addEventListener('click', function() {
            steps[currentStep].classList.remove('active');
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.add(
                'hidden'));
            currentStep--;
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.remove(
                'hidden'));
            updateFormSteps();
            updateProgressBar();
        });

        vertical_prev2.addEventListener('click', function() {
            steps[currentStep].classList.remove('active');
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.add(
                'hidden'));
            currentStep--;
            formSteps[currentStep].querySelectorAll('button').forEach(button => button.classList.remove(
                'hidden'));
            updateFormSteps();
            updateProgressBar();
        });

        function updateFormSteps() {
            formSteps.forEach((step, index) => {
                if (index <= currentStep) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }

        function updateProgressBar() {
            const activeSteps = document.querySelectorAll('.step.active').length;
            const totalSteps = steps.length;
            const heightPercent = (activeSteps / totalSteps) * 100;
            line.style.height = `calc(${heightPercent}% - 30px)`;
        }
    });
</script>

<script>
    // clipboard1
    let btn = document.getElementById('clipboard-btn1');
    let clipboard = new ClipboardJS(btn);

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });


    // clipboard2
    let btn2 = document.getElementById('clipboard-btn2');
    let clipboard2 = new ClipboardJS(btn2);

    clipboard2.on('success', function(e) {
        console.log(e);
    });

    clipboard2.on('error', function(e) {
        console.log(e);
    });

    // clipboard3
    let btn3 = document.getElementById('clipboard-btn3');
    let clipboard3 = new ClipboardJS(btn3);

    clipboard3.on('success', function(e) {
        console.log(e);
    });

    clipboard3.on('error', function(e) {
        console.log(e);
    });

    // clipboard3
    let btn4 = document.getElementById('clipboard-btn4');
    let clipboard4 = new ClipboardJS(btn4);

    clipboard4.on('success', function(e) {
        console.log(e);
    });

    clipboard4.on('error', function(e) {
        console.log(e);
    });


    // clipboard5
    let btn5 = document.getElementById('clipboard-btn5');
    let clipboard5 = new ClipboardJS(btn5);

    clipboard5.on('success', function(e) {
        console.log(e);
    });

    clipboard5.on('error', function(e) {
        console.log(e);
    });

    // clipboard5
    let btn6 = document.getElementById('clipboard-btn6');
    let clipboard6 = new ClipboardJS(btn6);

    clipboard6.on('success', function(e) {
        console.log(e);
    });

    clipboard6.on('error', function(e) {
        console.log(e);
    });
</script>
