import { Modal } from 'flowbite';
import type { ModalOptions, ModalInterface } from 'flowbite';
import type { InstanceOptions } from 'flowbite';

const $modalElement: HTMLElement = document.querySelector('#default-modal');

const modalOptions: ModalOptions = {
    placement: 'center',
    backdrop: 'static',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
        console.log('modal is hidden');
    },
    onShow: () => {
        console.log('modal is shown');
    },
    onToggle: () => {
        console.log('modal has been toggled');
    },
};

// instance options object
const instanceOptions: InstanceOptions = {
    id: 'default-modal',
    override: true
};

const modal: ModalInterface = new Modal($modalElement, modalOptions, instanceOptions);

const closeButton = document.getElementById('closeModal');
if (closeButton) {
    closeButton.addEventListener("click", () => {
        modal.hide();
    });
}

modal.show();