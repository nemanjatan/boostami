jQuery(document).ready(function ($) {
    var mediaUploader;

    $(document).on('click', '.button.bostami_upload_button', function (e) {
        e.preventDefault();
        var targetId = $(this).data('input');
        var inputField = $('#' + targetId);

        // Re-initialize mediaUploader every time an upload button is clicked
        mediaUploader = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url); // Update the target field
            // Optionally update the image preview if needed
            inputField.siblings('.bostami_icon_preview').attr('src', attachment.url);
        });

        mediaUploader.open();
    });

    $('#bostami_add_new_item').click(function () {
        var container = $('#bostami_what_i_do_container');
        var newIndex = container.children().length; // Assuming each child is a "What I Do" item

        // Replace {{index}} in the template with the actual new index
        var newItemHtml = $('#bostami_what_i_do_template').html().replace(/{{index}}/g, newIndex);
        container.append(newItemHtml);
    });

    $('#bostami_add_new_resume_item').click(function () {
        var container = $('#bostami_resume_container');
        var newIndex = container.children().length; // Assuming each child is a "What I Do" item

        // Replace {{index}} in the template with the actual new index
        var newItemHtml = $('#bostami_resume_template').html().replace(/{{index}}/g, newIndex);
        container.append(newItemHtml);
    });

    $('#bostami_add_new_resume_skills_item').click(function () {
        var container = $('#bostami_resume_skills_container');
        var newIndex = container.children().length;

        // Replace {{index}} in the template with the actual new index
        var newItemHtml = $('#bostami_resume_skills_template').html().replace(/{{index}}/g, newIndex);
        container.append(newItemHtml);
    });

    $('#bostami_add_new_resume_knowledge_item').click(function () {
        var container = $('#bostami_resume_knowledge_container');
        var newIndex = container.children().length;

        // Replace {{index}} in the template with the actual new index
        var newItemHtml = $('#bostami_resume_knowledge_template').html().replace(/{{index}}/g, newIndex);
        container.append(newItemHtml);
    });

    $(document).on('click', '.bostami_remove_icon_button', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove this element?')) {
            $(this).closest('.bostami_what_i_do_item').remove();
            // $(this).closest('form').submit();
        }
    });

    $(document).on('click', '.bostami_resume_remove_icon_button', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove this element?')) {
            $(this).closest('.bostami_resume_item').remove();
            // $(this).closest('form').submit();
        }
    });

    $(document).on('click', '.bostami_resume_skills_remove_icon_button', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove this element?')) {
            $(this).closest('.bostami_resume_skills_item').remove();
            // $(this).closest('form').submit();
        }
    });

    $(document).on('click', '.bostami_resume_knowledge_remove_icon_button', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove this element?')) {
            $(this).closest('.bostami_resume_knowledge_item').remove();
            // $(this).closest('form').submit();
        }
    });

    $('.nav-tab').click(function (e) {
        e.preventDefault();
        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('.tab-content').removeClass('active');

        var tab = $(this).data('tab');
        $('#' + tab).addClass('active');
    });

    // Add new client
    $('#bostami_add_new_client').click(function () {
        var container = $('#bostami_clients_container');
        var newIndex = container.children().length; // Assuming each child is a client item

        // Replace {{index}} in the template with the actual new index
        var newItemHtml = $('#bostami_client_template').html().replace(/{{index}}/g, newIndex);
        container.append(newItemHtml);
    });

    $('#bostami_add_new_portfolio').click(function () {
        var container = $('#bostami_portfolio_container');
        var newIndex = container.children().length; // Assuming each child is a client item

        // Replace {{index}} in the template with the actual new index
        var newItemHtml = $('#bostami_portfolio_template').html().replace(/{{index}}/g, newIndex);
        container.append(newItemHtml);
    });

    // Remove client
    $(document).on('click', '.bostami_remove_client_button', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove this client?')) {
            $(this).closest('.bostami_client_item').remove();
        }
    });

    $(document).on('click', '.bostami_remove_portfolio_button', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove this client?')) {
            $(this).closest('.bostami_portfolio_item').remove();
        }
    });

    $('.resume-tab-link').click(function (e) {
        e.preventDefault();
        $('.resume-tab-link').removeClass('active');
        $(this).addClass('active');
        $('.resume-tab-content').removeClass('active');
        $('#' + $(this).data('tab')).addClass('active');
    });
});
