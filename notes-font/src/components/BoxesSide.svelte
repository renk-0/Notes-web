<script>
	import {createEventDispatcher} from "svelte";
	import axios from "axios";
	import Box from "./Box.svelte";
	
	const dispatcher = createEventDispatcher();
	export let boxes;
	let currentNote;

	function changeNote(box) {
		console.log(box);
	}

</script>

{#each boxes as box}
	<Box {...box} on:click={() => changeNote(this)} />
{/each}
