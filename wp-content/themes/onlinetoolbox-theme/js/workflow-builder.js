/**
 * Core logic for the Workflow Builder
 */
jQuery(document).ready(function($) {
    // --- DOM Elements ---
    const stepsContainer = $('#workflow-steps-container');
    const addStepBtn = $('#add-step-btn');
    const runWorkflowBtn = $('#run-workflow-btn');
    const workflowInput = $('#workflow-input');
    const workflowOutput = $('#workflow-output');
    const saveBtn = $('#save-workflow-btn');
    const workflowNameInput = $('#workflow-name');
    const savedWorkflowsList = $('#saved-workflows-list ul');

    let stepCounter = 0;

    // --- Core Functions ---

    function addStep(tool, mode) {
        stepCounter++;
        // For now, we only have one tool, so the UI is hardcoded for it.
        const newStep = `
            <div class="workflow-step" data-tool-type="${tool}" data-step-id="${stepCounter}">
                <h4>Step ${stepCounter}: Case Converter</h4>
                <select class="step-tool-mode">
                    <option value="uppercase" ${mode === 'uppercase' ? 'selected' : ''}>Convert to UPPERCASE</option>
                    <option value="lowercase" ${mode === 'lowercase' ? 'selected' : ''}>Convert to lowercase</option>
                    <option value="sentencecase" ${mode === 'sentencecase' ? 'selected' : ''}>Convert to Sentence case</option>
                    <option value="titlecase" ${mode === 'titlecase' ? 'selected' : ''}>Convert to Title Case</option>
                </select>
                <button class="remove-step-btn">Remove</button>
                <hr>
            </div>
        `;
        stepsContainer.append(newStep);
    }

    function getWorkflowData() {
        const steps = [];
        $('.workflow-step').each(function() {
            const step = {
                tool: $(this).data('tool-type'),
                mode: $(this).find('.step-tool-mode').val()
            };
            steps.push(step);
        });
        return steps;
    }

    // --- Event Handlers ---

    addStepBtn.on('click', function() {
        addStep('case-converter', 'uppercase'); // Add a default step
    });

    stepsContainer.on('click', '.remove-step-btn', function() {
        $(this).closest('.workflow-step').remove();
    });

    runWorkflowBtn.on('click', function() {
        let currentText = workflowInput.val();
        const steps = getWorkflowData();

        steps.forEach(function(step) {
            if (step.tool === 'case-converter' && typeof applyCaseConversion === 'function') {
                currentText = applyCaseConversion(currentText, step.mode);
            }
        });

        workflowOutput.val(currentText);
    });

    // --- Save & Load AJAX ---

    saveBtn.on('click', function() {
        const workflowName = workflowNameInput.val();
        const workflowSteps = getWorkflowData();

        if (!workflowName) {
            alert('Please enter a name for your workflow.');
            return;
        }
        if (workflowSteps.length === 0) {
            alert('Cannot save an empty workflow.');
            return;
        }

        $.ajax({
            url: workflow_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'save_workflow',
                nonce: workflow_ajax_object.nonce,
                title: workflowName,
                steps: JSON.stringify(workflowSteps)
            },
            success: function(response) {
                if (response.success) {
                    alert('Workflow saved!');
                    // Add to the list dynamically
                    const newListItem = `
                        <li>
                            ${response.data.title}
                            <button class="load-workflow-btn" data-workflow-id="${response.data.post_id}">Load</button>
                        </li>
                    `;
                    // If the list was showing "You have no saved workflows", remove it
                    if (savedWorkflowsList.find('p').length > 0) {
                        savedWorkflowsList.empty().append('<ul></ul>');
                    }
                    savedWorkflowsList.find('ul').append(newListItem);
                    workflowNameInput.val('');
                } else {
                    alert('Error: ' + response.data);
                }
            }
        });
    });

    $('#saved-workflows-list').on('click', '.load-workflow-btn', function() {
        const button = $(this);
        const postId = button.data('workflow-id');

        $.ajax({
            url: workflow_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_workflow',
                nonce: workflow_ajax_object.nonce,
                post_id: postId
            },
            success: function(response) {
                if (response.success) {
                    stepsContainer.empty(); // Clear current steps
                    response.data.steps.forEach(function(step) {
                        addStep(step.tool, step.mode);
                    });
                    alert('Workflow loaded!');
                } else {
                    alert('Error: ' + response.data);
                }
            }
        });
    });
});
