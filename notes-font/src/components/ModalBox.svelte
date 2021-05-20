<script>
	import {createEventDispatcher} from "svelte";
	import axios from "axios";
	
	const dispatcher = createEventDispatcher();
	let hidden = true, val;
	export const toggle = () => hidden = !hidden;
	
	function createBox() {
		let name = val.value;
		if(name.length > 0) {
			axios.post("http://localhost/Notas/addBox", { name })
				.then(resp => {
					dispatcher("added", {
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
		<div class="modal-head"></div>
			<div class="modal-body">
				<input required type="text" bind:this={val}>
			</div>
		<div class="modal-footer">
			<button class="secondary" on:click={toggle}>Cancel</button>
			<button class="primary" on:click={createBox}>Create</button>
		</div>
	</div>
</div>
