<script>
	import {createEventDispatcher} from "svelte";
	import axios from "axios";

	export let boxList;
	const dispatcher = createEventDispatcher();
	let hidden = true;
	let val;
	export const toggle = () => hidden = !hidden;
	
	function createBox() {
		let name = val.value;
		if(name.length > 0) {
			axios.post("http://localhost/Notas/addBox", { name })
				.then(resp => {
					boxList.add_box({
						id: resp.data,
						name,
						creation: Date.now().toString()
					});
					toggle();
				});	
		}
	} 
</script>

<div class="modal" class:hidden={hidden}>
	<div class="modal-bg"></div>
	<div class="modal-container">
			<div class="modal-head">
				<h2>Crear una nueva caja</h2>
			</div>
			<div class="modal-body">
				<div class="input">
					<label for="box_name">Nombre de la caja</label>
					<input id="box_name" required type="text" bind:this={val}>
				</div>
			</div>
		<div class="modal-footer right">
			<button class="secondary" on:click={toggle}>Cancel</button>
			<button class="primary" on:click={createBox}>Create</button>
		</div>
	</div>
</div>
