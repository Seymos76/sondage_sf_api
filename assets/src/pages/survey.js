import React, { useState, useEffect } from 'react'
import { createRoot } from "react-dom/client";
import Sondage from "../components/Sondage";

const API_URL = 'https://localhost:8000';

export default function Survey() {
    const [sondage, setSondage] = useState(new Sondage());
    const [loading, setLoading] = useState(true);
    const [serverMessage, setServerMessage] = useState('');
    useEffect(() => {
        setServerMessage("Chargement du serveur...");
        const isAwake = fetch(API_URL+'/api/is-awake', {
                "method": 'GET',
                "mode": "cors",
                "headers": {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": API_URL
                }
            })
                .then((response) => {
                    console.log('is awake response',response);
                    if (!response.ok) {
                        setServerMessage("Le serveur ne répond pas...");
                        setLoading(false);
                    }
                    if (200 !== response.status) {
                        setServerMessage("Le serveur ne répond pas...");
                        setLoading(false);
                    }
                    setServerMessage("Le serveur est à présent disponible !");
                    setLoading(false);
                    return response;
                })
                .catch((error) => {
                    if (undefined !== error) {
                        setServerMessage("Le serveur est indisponible actuellement, merci de réessayer plus tard.");
                    }
                    console.log('error',error);
                    return error;
                })
        ;
        console.log('isAwake',isAwake);
    }, []);
    useEffect(() => {
        console.log('sondage state',sondage);
    }, [sondage]);
    const handleSubmit = async (event) => {
        event.preventDefault();
        let currentSondage = {...sondage}
        console.log(JSON.stringify(currentSondage));
        const submitResponse = fetch(API_URL+'/api/surveys', {
            "method": 'POST',
            "body": JSON.stringify(currentSondage),
            "mode": "no-cors",
            "headers": {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                "Access-Control-Request-Method": "POST",
            }
        })
            .then((response) => response)
            .then((data) => {
                    console.log('data',data);
                    return data;
                }
            )
            .catch((error) => {
                if (undefined !== error) {
                    setServerMessage("Le formulaire n'a pas pu être envoyé.");
                }
                console.log('error',error);
                return error;
            });
        console.log('submitResponse',submitResponse);
    }
    const handleChange = ({ target }) => {
        const { name, value } = target;
        //const currentSondage = {...sondage};
        console.log('sondage state before',sondage);
        //console.log('current sondage before',currentSondage);
        //sondage.change(name, value);
        //sondage[name] = value;
        sondage.change(name, value);
        //currentSondage.change(name, value);
        /*setSondage({
            ...sondage,
            [name]: value
        });*/
        setSondage(sondage);
        console.log('sondage state after',sondage);
        //console.log('current sondage after',currentSondage);
        //setSondage((sondage) => sondage[name] = value);
    }
    const handleMultipleChoiceField = ({ target }) => {
        const { name, value } = target;
        let currentSondage = {...sondage};
        if (currentSondage[name] === undefined) {
            return;
        }
        if (currentSondage[name]?.includes(value)) {
            const index = currentSondage[name].indexOf(value);
            currentSondage[name].splice(index,1);
        } else {
            currentSondage[name].push(value);
        }
        console.log('current sondage ',currentSondage);
        setSondage(currentSondage);
    }
    function handleIsFamiliar({ target }) {
        const { name, value } = target;
        console.log('target',name,value,sondage);
        if ('familiar_with_energy' === name) {
            sondage.setFamiliar(value);
            setSondage(sondage);
            console.log('sondage',sondage);
        }
    }
    // console.log('API URL',API_URL);
    return (
        <div>
            <div className={'container'}>
                <h1 className={'text-center'}>
                    Le 3e oeil et sa multidimension.
                </h1>

                <form action="" method="post" onSubmit={handleSubmit}>
                    <fieldset className='mb-3 form-group'>
                        <label htmlFor="">Etes-vous familier(ère) avec un ou plusieurs domaines de l'énergétique ?</label>
                        <br/>
                        <input type="radio" name="familiar_with_energy" value={'true'} id="" onInput={handleIsFamiliar} /> Oui
                        <br/>
                        <input type="radio" name="familiar_with_energy" value={'false'} id="" onInput={handleIsFamiliar} /> Non
                    </fieldset>
                    <p>Familier : {'yes' === sondage?.isFamiliar() ? "Oui" : "Non"}</p>
                    {sondage.isFamiliar() ? <div>
                        <fieldset className='mb-3 form-group'>
                            <label htmlFor="">Qu'est-ce qui vous a amené(e) à vous intéresser à l'énergétique ?</label>
                            <textarea name="what_did_bring_you_to_energetic" id="" cols={30} rows={10} className={'form-control'} onChange={handleChange}></textarea>
                        </fieldset>
                        <fieldset className='mb-3 form-group'>
                            <label htmlFor="">Etes-vous vous-même praticien(ne) (professionnel(le) ou non) ?</label>
                            <br/>
                            <input type="radio" name="is_practician" value={'true'} id="" onChange={handleChange} /> Oui
                            <br/>
                            <input type="radio" name="is_practician" value={'false'} id="" onChange={handleChange} /> Non
                        </fieldset>
                        {sondage.isPractician() && <>
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">Dans quel(s) domaine(s) ?</label>
                                <textarea name="in_which_domains_are_you" id="" cols={30} rows={10} className={'form-control'} onChange={handleChange}></textarea>
                            </fieldset>
                        </>}
                        <fieldset className='mb-3 form-group'>
                            <label htmlFor="">Si vous avez déjà des perceptions subtiles, avec lesquelles êtes-vous le plus à l'aise ?</label><br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"vision"} onChange={handleMultipleChoiceField} /> Vision / clair-voyance<br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"audience"} onChange={handleMultipleChoiceField} /> Ouïe / clair-audience<br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"touch"} onChange={handleMultipleChoiceField} /> Toucher / clair-ressenti<br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"olfaction"} onChange={handleMultipleChoiceField} /> Odorat / clair-olfaction<br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"gustative"} onChange={handleMultipleChoiceField} /> Goût / clair-gustatif<br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"none"} onChange={handleMultipleChoiceField} /> Aucune / clair-nada<br/>
                            <input type="checkbox" name="subtiles_perceptions" id="" value={"idontknow"} onChange={handleMultipleChoiceField} /> Je ne pense pas avoir de perception subtile<br/>
                        </fieldset>
                    </div> : <></>}
                    <fieldset className='mb-3 form-group'>
                        <label htmlFor="">Seriez-vous intéressé(e) par une initiation au 3e oeil et à sa multidimension ?</label>
                        <br/>
                        <input type="radio" name="is_interested_by_initiation" value={'true'} id="" onChange={handleChange} /> Oui
                        <br/>
                        <input type="radio" name="is_interested_by_initiation" value={'false'} id="" onChange={handleChange} /> Non
                    </fieldset>
                    <fieldset className='mb-3 form-group'>
                        <label htmlFor="">Pourquoi ?</label>
                        <textarea name="why_are_you_interested_by_initiation" id="" cols={30} rows={10} className={'form-control'} onChange={handleChange}></textarea>
                    </fieldset>
                    {sondage.isInterestedByInitiation()
                        ? <>
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">Quels sujets complémentaires seraient susceptibles de vous intéresser ?</label><br/>
                                <input type="checkbox" name="subjects" id="" onChange={handleMultipleChoiceField} value={'vies_karmiques'} /> Vies karmiques<br/>
                                <input type="checkbox" name="subjects" id="" onChange={handleMultipleChoiceField} value={'multivers'} /> Multivers<br/>
                                <input type="checkbox" name="subjects" id="" onChange={handleMultipleChoiceField} value={'chakras_et_corps_energetiques'} /> Charkras et corps énergétiques<br/>
                                <input type="checkbox" name="subjects" id="" onChange={handleMultipleChoiceField} value={'other'} /> Autres<br/>
                                {sondage.wantsOtherSubjects()
                                    ?
                                    <>
                                        <textarea name="other_subjects" id="" cols={30} rows={10} className={'form-control'} onChange={handleChange} placeholder={"Merci de faire une liste des sujets que vous aimeriez aborder"}></textarea>
                                    </>
                                    : <></>
                                }
                            </fieldset>
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">Quel serait pour vous le bon équilibre entre contenus écrit, audio et vidéo ?</label>
                                <br/>
                                <input type="radio" name="content_type_preference" value={'more_writing'} id="" onChange={handleChange} /> Ecrit de préférence<br/>
                                <input type="radio" name="content_type_preference" value={'more_audio'} id="" onChange={handleChange} /> Audio de préférence<br/>
                                <input type="radio" name="content_type_preference" value={'more_video'} id="" onChange={handleChange} /> Vidéo de préférence<br/>
                                <input type="radio" name="content_type_preference" value={'balanced_mix'} id="" onChange={handleChange} /> Un mix équilibré des trois
                            </fieldset>
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">Pensez-vous avoir besoin d'un suivi pendant la durée de l'initiation ?</label>
                                <br/>
                                <input type="radio" name="need_following" value={'individual'} id="" onChange={handleChange} /> Suivi individuel<br/>
                                <input type="radio" name="need_following" value={'grouped'} id="" onChange={handleChange} /> Suivi groupé<br/>
                                <input type="radio" name="need_following" value={'both'} id="" onChange={handleChange} /> Les deux<br/>
                                <input type="radio" name="need_following" value={'none'} id="" onChange={handleChange} /> Aucun
                            </fieldset>
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">A la fin de cette initiation, seriez-vous intéressé par une immersion de groupe ?</label>
                                <br/>
                                <input type="radio" name="interested_by_immersion" value={'true'} id="" onChange={handleChange} /> Oui<br/>
                                <input type="radio" name="interested_by_immersion" value={'false'} id="" onChange={handleChange} /> Non
                            </fieldset>
                            {sondage.isInterestedByImmersion()
                                ? <>
                                    <fieldset className='mb-3 form-group'>
                                        <label htmlFor="">Quelle dimension de groupe est la plus confortable pour vous ?</label>
                                        <select name="group_size" id="" className={'form-control'} onChange={handleChange}>
                                            <option value="1 week-end">Restreint (5 personnes max)</option>
                                            <option value="3 days">Moyen (6 à 10 personnes)</option>
                                            <option value="1 week">Plus il y a de monde et mieux c'est (10 personnes et plus)</option>
                                        </select>
                                    </fieldset>
                                    <fieldset className='mb-3 form-group'>
                                        <label htmlFor="">Pourquoi ?</label>
                                        <textarea name="why_are_you_interested_by_immersion" id="" cols={30} rows={10} className={'form-control'} onChange={handleChange}></textarea>
                                    </fieldset>
                                    {sondage.showTimeForImmersionField()
                                        ? <>
                                            <fieldset className='mb-3 form-group'>
                                                <label htmlFor="">Quelle serait pour vous la durée idéale de l'immersion ?</label>
                                                <select name="time_for_immersion" id="" className={'form-control'} onChange={handleChange}>
                                                    <option value="1 week-end">1 week-end</option>
                                                    <option value="3 days">3 jours</option>
                                                    <option value="1 week">1 semaine</option>
                                                    <option value="other">Autre</option>
                                                </select>
                                                {sondage.showTimeForImmersionOtherField()
                                                    ? <>
                                                        <fieldset className='mb-3 form-group'>
                                                            <label htmlFor="">Quelle durée en jours ?</label>
                                                            <input type="number" name="custom_time_for_immersion" min={1} id="" className={'form-control'} onChange={handleChange} />
                                                        </fieldset>
                                                    </>
                                                    : <></>}
                                            </fieldset>
                                        </>
                                        : <></>
                                    }
                                </>
                                : <></>
                            }
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">Auriez-vous des questions qui concernent l'initiation ?</label>
                                <textarea name="have_you_some_questions" id="" cols={30} rows={10} className={'form-control'} onChange={handleChange}></textarea>
                            </fieldset>
                            <fieldset className='mb-3 form-group'>
                                <label htmlFor="">Votre email ?</label>
                                <input type="email" name="lead_email" id="" className={'form-control'} onChange={handleChange} />
                            </fieldset>
                            <fieldset className='mb-3 form-group'>
                                <input type="checkbox" name="agree_for_notification" id="" onChange={handleChange} /> J'accepte d'être prévenu par email à la sortie du guide.
                            </fieldset>
                        </>
                        : <></>}
                    {serverMessage && <p>{serverMessage}</p>}
                    {!loading && <button type="submit" className='btn btn-primary'>Soumettre mes réponses</button>}
                </form>
            </div>
        </div>
    )
}

const surveyNodeElement = document.querySelector("#survey");
const surveyRoot = createRoot(surveyNodeElement);
surveyRoot.render(<Survey/>);
