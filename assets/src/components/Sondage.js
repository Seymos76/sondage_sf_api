export default
class Sondage {
  title = "Sondage pour guide multidimensionnel du 3e oeil";
  familiar_with_energy = '';
  what_did_bring_you_to_energetic = '';
  is_practician = '';
  in_which_domains_are_you = '';
  subtiles_perceptions = [];
  is_interested_by_initiation = '';
  why_are_you_interested_by_initiation = '';
  subjects = [];
  other_subjects = '';
  content_type_preference = '';
  need_following = '';
  interested_by_immersion = '';
  group_size = '';
  why_are_you_interested_by_immersion = '';
  time_for_immersion = '';
  custom_time_for_immersion = '';
  have_you_some_questions = '';
  lead_email = '';
  agree_for_notification = false;

  change = (name, value) => {
      this[name] = value;
  }
  setFamiliar = (value) => {
      this.familiar_with_energy = value;
  }

  showTimeForImmersionField = () => {
    return 'false' === this.interested_by_immersion;
  }
  showTimeForImmersionOtherField = () => {
    return 'other' === this.time_for_immersion;
  }
  isInterestedByInitiation = () => {
    return 'true' === this.is_interested_by_initiation;
  }
  isInterestedByImmersion = () => {
    return 'true' === this.interested_by_immersion;
  }
  isFamiliar = () => {
    return 'true' === this.familiar_with_energy;
  }
  isPractician = () => {
    return 'true' === this.is_practician;
  }
  wantsOtherSubjects = () => {
    return this.subjects?.includes('other');
  }
}
