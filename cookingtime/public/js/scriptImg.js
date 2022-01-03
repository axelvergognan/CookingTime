function getTaille(){
    const fichier = document.getElementById('img');
    if (fichier.files.length > 0) {
        for (const i = 0; i <= fichier.files.length - 1; i++)
        {
            const fichier_taille = fichier.files.item(i).size;
            const taille = (fichier_taille/1024000).toFixed(2);
            if(taille > 30)
                document.getElementById('fileSizeMess').innerHTML = 'Le fichier est trop volumineux (supérieur à 10Kb)';

            else
                document.getElementById('fileSizeMess').innerHTML = taille+'Mo';
        }
    }
}