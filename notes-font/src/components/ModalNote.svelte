<script>
	import axios from "axios";
	
	export let boxList;
	let hidden = true;
	let box_selected = false;
	let noteName;
	
	export const toggle = () => hidden = !hidden;
	export const select_box = () => box_selected = true;

	function create_note() {
		let box = boxList.get_current()
		let name = noteName.value;
		if(name.length > 0) {
			axios.post("http://localhost/Notas/addNote", { 
				name, 
				content: "", 
				box_id: box.get_id()
			})
				.then(resp => { 
					toggle();
					box.add_note({ id: resp.data, name });
				});	
		}
	} 
</script>


<div class="modal" class:hidden={hidden}>
	<div class="modal-bg"></div>
		<div class="modal-container">
			<div class="modal-head">
				<h2>Crear nueva nota</h2>
			</div>
			<div class="modal-body">
				<div class="input">
					<label for="note_name">Nombre de la nota</label>
					<input id="note_name" required type="text" bind:this={noteName}>
				</div>
			</div>
		<div class="modal-footer right">
			<button class="secondary" on:click={toggle}>Cancel</button>
			{#if box_selected}
				<button class="primary" on:click={create_note}>Create</button>
			{:else}
				<button class="primary" disabled>Create</button>
			{/if}
		</div>
	</div>
</div>
