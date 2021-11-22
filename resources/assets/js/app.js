import Application from '../../../../backend-module/resources/assets/js/resources/Application';
import Alert from '../../../../backend-module/resources/assets/js/utils/alert';

Application.init(_ => {
    // find new customer modal
    let newCustomerModal = document.querySelector('#new-customer-modal');
    if ( !newCustomerModal ) return;

    // get parent modal
    let parent = newCustomerModal.parentElement.closest('.modal');
    // get registered instance of searchmodal
    let searchModal = Application.instance( parent.id );
    // get form of new customer modal
    let form = newCustomerModal.querySelector('form');

    parent.addEventListener('keydown', e => {
        // check if
        if (e.shiftKey && e.key === 'F3')
            // show modal
            Application.$(newCustomerModal).modal('show');
    });

    // capture modal hdie
    Application.$(newCustomerModal).on('hidden.bs.modal', e => {
        // reset fields
        form.querySelectorAll('input').forEach(input => input.value = null);
        // change flag
        working = false;
    });

    Application.$(newCustomerModal).on('shown.bs.modal', e => {
        // set focus on first filter field
        let focused = false;
        form.querySelectorAll('input,select').forEach(field => {
            // ignore if already on focus or element is not visible
            if (focused || field.offsetParent === null) return;
            // change flag
            focused = true;
            // focus and select element
            setTimeout(_ => {
                field.focus();
                if (field.select) field.select();
            }, 50);
        });
    });

    let working = false;

    // capture form submit
    form.addEventListener('submit', e => {
        // prevent default action
        e.preventDefault();

        if (working) return;
        working = true;

        // build data for customer creation
        let data = { 'customer[active]': true };
        form.querySelectorAll('input').forEach(input => data[input.name] = input.value);
        // copy attributes to person
        data.documentno = data['customer[ftid]'];
        data.firstname = data['customer[business_name]'];

        Application.$.ajax({
            method: form.method,
            url: form.action,
            data: data,
            success: resource => {
                if (!resource.id) {
                    working = false;
                    let message = '';
                    Object.entries(resource).forEach(entry => {
                      const [key, value] = entry;
                      message += value + "<br>\n";
                    });
                    return Alert.error('Error', message);
                }
                // copy ftid to resource root
                resource.ftid = resource.customer.ftid;
                // redirect data to event on searchModal
                searchModal.selected(resource);
                // hide local modal
                Application.$(newCustomerModal).modal('hide');
            }
        });
    });

});
