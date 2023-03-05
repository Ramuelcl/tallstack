<div>
    <x-comp-modal :showModal="$showModal">
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-base font-semibold leading-6 text-gray-700 dark:text-gray-50" id="modal-title">
                Editando Registro
            </h3>
            <div class="mt-2">
                <form>
                    <div class="flex">
                        <x-forms.input idName="name" label="Nombre" placeholder="Ingrese Nombre"></x-forms.input>
                        <x-forms.input idName="email" label="eMail" type="mail" placeholder="Ingrese eMail"></x-forms.input>
                    </div>
                    <div class="flex">
                        <x-forms.input-checkbox idName="is_active" label="Activo" placeholder="Ingrese estado"></x-forms.input-checkbox>
                        <x-forms.input idName="profile_photo_path" label="Foto" placeholder="Ingrese Foto"></x-forms.input>
                    </div>

                    <x-forms.input-select idName="role" label="Roles" placeholder="Defina el rol" :opciones="['admin', 'user', 'moderator']"></x-forms.input-select>

                    <div class="flex">
                        <x-forms.input-password idName="password" label="Contraseña" placeholder="Ingrese Contraseña"></x-forms.input-password>
                        <x-forms.input-password idName="password_confirm" label="repite Contraseña" placeholder="Ingrese Contraseña"></x-forms.input-password>
                    </div>
                </form>

            </div>
        </div>
    </x-comp-modal>
</div>