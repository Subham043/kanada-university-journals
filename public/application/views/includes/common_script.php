<script src="<?php echo base_url('assets/admin/js/pages/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/jquery.validation.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/jquery.repeater.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/just-validate.production.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/iziToast.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/node-waves/waves.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/feather-icons/feather.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/plugins/lord-icon-2.1.0.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/axios.min.js'); ?>"></script>
    <script type="text/javascript">
        const errorToast = (message) => {
            iziToast.error({
                title: 'Error',
                message: message,
                position: 'bottomCenter',
                timeout: 7000
            });
        }
        const successToast = (message) => {
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'bottomCenter',
                timeout: 6000
            });
        }

        const CHOICE_CONFIG = {
                silent: false,
                items: [],
                renderChoiceLimit: -1,
                maxItemCount: -1,
                addItems: true,
                addItemFilter: null,
                removeItems: true,
                removeItemButton: false,
                editItems: false,
                allowHTML: true,
                duplicateItemsAllowed: true,
                delimiter: ',',
                paste: true,
                searchEnabled: true,
                searchChoices: true,
                searchFloor: 1,
                searchResultLimit: 4,
                searchFields: ['label', 'value'],
                position: 'auto',
                resetScrollPosition: true,
                shouldSort: true,
                shouldSortItems: false,
                // sorter: () => {...},
                placeholder: true,
                searchPlaceholderValue: null,
                prependValue: null,
                appendValue: null,
                renderSelectedChoices: 'auto',
                loadingText: 'Loading...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices to choose from',
                itemSelectText: 'Press to select',
                addItemText: (value) => {
                    return `Press Enter to add <b>"${value}"</b>`;
                },
                maxItemText: (maxItemCount) => {
                    return `Only ${maxItemCount} values can be added`;
                },
                valueComparer: (value1, value2) => {
                    return value1 === value2;
                },
                classNames: {
                    containerOuter: 'choices',
                    containerInner: 'choices__inner',
                    input: 'choices__input',
                    inputCloned: 'choices__input--cloned',
                    list: 'choices__list',
                    listItems: 'choices__list--multiple',
                    listSingle: 'choices__list--single',
                    listDropdown: 'choices__list--dropdown',
                    item: 'choices__item',
                    itemSelectable: 'choices__item--selectable',
                    itemDisabled: 'choices__item--disabled',
                    itemChoice: 'choices__item--choice',
                    placeholder: 'choices__placeholder',
                    group: 'choices__group',
                    groupHeading: 'choices__heading',
                    button: 'choices__button',
                    activeState: 'is-active',
                    focusState: 'is-focused',
                    openState: 'is-open',
                    disabledState: 'is-disabled',
                    highlightedState: 'is-highlighted',
                    selectedState: 'is-selected',
                    flippedState: 'is-flipped',
                    loadingState: 'is-loading',
                    noResults: 'has-no-results',
                    noChoices: 'has-no-choices'
                },
                // Choices uses the great Fuse library for searching. You
                // can find more options here: https://fusejs.io/api/options.html
                fuseOptions: {
                    includeScore: true
                },
                labelId: '',
                callbackOnInit: null,
                callbackOnCreateTemplates: null
            };

        const spinner = `
                <span class="d-flex align-items-center">
                    <span class="spinner-border flex-shrink-0" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                    <span class="flex-grow-1 ms-2">
                        Loading...
                    </span>
                </span>
            `;
    </script>
    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) { ?>

            successToast('<?php echo $this->session->flashdata('success') ?>');

        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>

            errorToast('<?php echo $this->session->flashdata('error') ?>');

        <?php } ?>
    </script>

    <!-- particles js -->
    <script src="<?php echo base_url('assets/admin/libs/particles.js/particles.js'); ?>"></script>
    <!-- particles app js -->
    <script src="<?php echo base_url('assets/admin/js/pages/particles.app.js'); ?>"></script>