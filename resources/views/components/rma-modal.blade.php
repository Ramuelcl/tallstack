<div id="modal-component-container" class="{{ $show }} fixed inset-0">
    <div id="modal-flex-container" class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div id="modal-bg-container" class="fixed inset-0 bg-gray-700 bg-opacity-75">

        </div>
        <div id="modal-space-container" class="hidden sm:inline-block sm:align-middle sm:h-screen"></div>

        <div id="modal-container" class="inline-block align-bottom bg-gray-50 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div id="modal-wrapper" class="bg-gray-50 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div id="modal-wrapper-flex" class="sm:flex sm:items-start">
                    <div id="modal-icon" class="mx-auto flex flex-shrink-0 items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">

                    </div>
                    <div id="modal-content" class="text-center mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium text-gray-900">Eliminar elemento</h3>
                        <div id="modal-text" class="mt-2">
                            <p class="text-gray-500 text-sm">Seguro quieres eliminar el elemento?</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-actions" class="bg-gray-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <x-botonSecondary id="close-modal">Cancelar</x->
                    <x-botonSuccess>Ok</x-botonSuccess>
                    <!-- <x-botonPrimary>Primary</x-botonPrimary>
                    <x-botonInfo>Info</x-botonInfo>
                    <x-botonSecondary>Secondary</x-botonSecondary>
                    <x-botonSuccess>Success</x-botonSuccess>
                    <x-botonWarning>Warning</x-botonWarning> -->


            </div>
        </div>
    </div>
</div>
<script>
    const closeButton = document.querySelector("#close-modal");
    const showButton = document.querySelector("#open-modal");
    const modalContainer = document.querySelector("#modal-componer-container");
    const modal = document.querySelector("#modal-container");

    openButton.addEventListener("click", () => {
        openModal();
    });

    closeButton.addEventListener("click", () => {
        closeModal();
    });

    function openModal() {
        showAndHide(modalContainer, ["block", "bg-fadeIn"], ["hidden", "bg-fadeOut"]);
        showAndHide(modal, ["modal-scaleIn"], ["modal-scaleOut"]);
    }

    function closeModal() {
        showAndHide(modalContainer, ["bg-fadeOut"], ["bg-fadeIn"]);
        showAndHide(modal, ["modal-scaleOut"], ["modal-scaleIn"]);
    }

    function showAndHide(element, classesToAdd, classesToRemove) {
        element.classList.remove(...classesToRemove);
        element.classList.remove(...classesToAdd);
    }
</script>