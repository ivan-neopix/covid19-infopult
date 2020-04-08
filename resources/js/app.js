require('./bootstrap');
import Tags from './tags';
import {onReady} from './utis';

onReady(() => {

    const tagsInput = document.getElementById('tags-input');
    const autocompleteContainer = document.getElementById('tags-autocomplete')
    const tagsOutput = document.getElementById('tags-output');

    if (tagsInput && autocompleteContainer && tagsOutput) {
        new Tags(tagsInput, autocompleteContainer, tagsOutput);
    }
});
