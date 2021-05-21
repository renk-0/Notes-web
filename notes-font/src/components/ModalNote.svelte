<script>
	import {createEventDispatcher} from "svelte";
	import axios from "axios";
	
	export let currentBox;
	const dispatcher = createEventDispatcher();
	let hidden = true;
	let noteName, noteContent;
	
	export const toggle = () => hidden = !hidden;

	function createNote() {
		let name = noteName.value;
		if(name.length > 0) {
			axios.post("http://localhost/Notas/addNote", { 
				name,
				content: "",
				box_id: currentBox
			})
				.then(resp => {
					dispatcher("newNote");
					toggle();
				});	
		}
	} 
</script>


<div class="modal" class:hidden={hidden}>
	<div class="modal-bg"></div>
	<div class="modal-container">
		<div class="modal-head"></div>
			<div class="modal-body">
				<input required type="text" bind:this={noteName}>
			</div>
		<div class="modal-footer">
			<button class="secondary" on:click={toggle}>Cancel</button>
			{#if currentBox > 0}
				<button class="primary" on:click={createNote}>Create</button>
			{:else}
				<button class="primary" disabled>Create</button>
			{/if}
		</div>
	</div>
</div>
