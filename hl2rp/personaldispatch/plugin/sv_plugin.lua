local PLUGIN = PLUGIN;
local SCHEMA = SCHEMA;
local Clockwork = Clockwork;

function PersonalDispatch(player,message)


local e = player:GetCharacterData("citizenid")

  if (message == "Person Interest") then
  	BroadcastLua("LocalPlayer():EmitSound('npc/overwatch/cityvoice/f_confirmcivilstatus_1_spkr.wav')")
	for k, v in ipairs( _player.GetAll() ) do
		Clockwork.chatBox:Add(nil, nil, "dispatch", "Attention please. Unidentified citizen #" .. e .. " of interest. Confirm your civil status with local protection team immediately.");

	end;
  end

    if (message == "Citizenship") then
    BroadcastLua("LocalPlayer():EmitSound('npc/overwatch/cityvoice/f_citizenshiprevoked_6_spkr.wav')")
	for k, v in ipairs( _player.GetAll() ) do
		Clockwork.chatBox:Add(nil, nil, "dispatch", "Citizen #" .. e .. ". You are convicted of multi anti-civil violations. Implicit citizenship revoked. Status: MALIGNANT.");

	end;
  end

  if (message == "Malcom") then
  	BroadcastLua("LocalPlayer():EmitSound('npc/overwatch/cityvoice/f_capitalmalcompliance_spkr.wav')")
		Clockwork.chatBox:Add(nil, nil, "dispatch", "Citizen #" .. e .. ". You are charged with capital malcompliance, anti-citizen status approved.");

  end

  if (message == "Reminder") then
  	BroadcastLua("LocalPlayer():EmitSound('npc/overwatch/cityvoice/f_innactionisconspiracy_spkr.wav')")
	Clockwork.chatBox:Add(nil, nil, "dispatch", "Citizen #" .. e .. " reminder. Inaction is conspiracy. Report counter behaviour to a Civil Protection team immediately.");		

  end

  if (message == "Anti-Civil One") then
  	BroadcastLua("LocalPlayer():EmitSound('npc/overwatch/cityvoice/f_anticivil1_5_spkr.wav')")
		Clockwork.chatBox:Add(nil, nil, "dispatch", "Citizen #" .. e .. ". You are charged with anti-civil activity level one. Protection unit prosecution code: DUTY, SWORD, OPERATE.");
  end

end;