$(".tab-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    }, 
    onFinished: function (event, currentIndex) {
        var form = $(this);
        console.log(form);
        form.defaultPrevented();
    }
});