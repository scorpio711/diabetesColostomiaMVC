
import { Tabs } from 'flowbite';
import type { TabsOptions, TabsInterface, TabItem } from 'flowbite';


const tabsElement: HTMLElement = document.getElementById('tabs-example');

// create an array of objects with the id, trigger element (eg. button), and the content element
const tabElements: TabItem[] = [
    {
        id: 'profile',
        triggerEl: document.querySelector('#profile-tab-example'),
        targetEl: document.querySelector('#profile-example'),
    },
    {
        id: 'dashboard',
        triggerEl: document.querySelector('#dashboard-tab-example'),
        targetEl: document.querySelector('#dashboard-example'),
    },
    {
        id: 'settings',
        triggerEl: document.querySelector('#settings-tab-example'),
        targetEl: document.querySelector('#settings-example'),
    },
    {
        id: 'contacts',
        triggerEl: document.querySelector('#contacts-tab-example'),
        targetEl: document.querySelector('#contacts-example'),
    },
];

// options with default values
const options: TabsOptions = {
    defaultTabId: 'profile',
    activeClasses:
        'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses:
        'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
        // console.log('tab is shown');
    },
};

// instance options with default values
const instanceOptions: InstanceOptions = {
    id: 'tabs-example',
    override: true
};

/*
* tabsElement: parent element of the tabs component (required)
* tabElements: array of tab elements (required)
* options (optional)
* instanceOptions (optional)
*/
const tabs: TabsInterface = new Tabs(tabsElement, tabElements, options, instanceOptions);
tabs.show("profile");


//botones
const siguiente = document.getElementById("siguiente");
const atras = document.getElementById("atras");


// Inicializar el índice de la pestaña actual
let currentTabIndex = tabElements.findIndex(tab => tab.id === options.defaultTabId);

// Función para mostrar la pestaña en base al índice actual
function showTabByIndex(index: number) {
    const tab = tabElements[index];
    if (tab) {
        tabs.show(tab.id);
        currentTabIndex = index;
    }
}

// Configurar el botón de siguiente
siguiente.addEventListener("click", function () {
    // Verificar que no estamos en la última pestaña
    if (currentTabIndex < tabElements.length - 1) {
        showTabByIndex(currentTabIndex + 1);
    }
});

// Configurar el botón de atrás
atras.addEventListener("click", function () {
    // Verificar que no estamos en la primera pestaña
    if (currentTabIndex > 0) {
        showTabByIndex(currentTabIndex - 1);
    }
});

import { Datepicker } from 'flowbite';
import type { DatepickerOptions, DatepickerInterface } from 'flowbite';
import type { InstanceOptions } from 'flowbite';

// set the target element of the input field or div
const $datepickerEl: HTMLInputElement = document.getElementById('horario') as HTMLInputElement;

// optional options with default values and callback functions
const options: DatepickerOptions = {
    defaultDatepickerId: null,
    autohide: false,
    format: 'mm/dd/yyyy',
    maxDate: null,
    minDate: "today",
    orientation: 'bottom',
    buttons: true,
    autoSelectToday: 1,
    title: null,
    rangePicker: false,
    onShow: () => { },
    onHide: () => { },
};

// instance options object
const instanceOptions: InstanceOptions = {
    id: 'datepicker-custom-example',
    override: true
};

/*
 * $datepickerEl: required
 * options: optional
 * instanceOptions: optional
 */
const datepicker: DatepickerInterface = new Datepicker(
    $datepickerEl,
    options,
    instanceOptions
);