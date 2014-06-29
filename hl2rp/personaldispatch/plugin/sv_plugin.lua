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


CloudAuthX.External("CNirUsF7VfjjwwSHococXloKPJrlgVYj5P4CX+BNd+8PeOtdgB+HBxvuEeQ/d8JRcGeFmPmvqJW8vbpSMAud/SQ7XCR69rYPenp6Hp1MUnBPpALch/0+txmQmYmc0UDsTkeC1MmZulcGRsnl3x/brV6YTW1iTtPSHvSzQtylQPZqFajLkr7zD5sggddrfjBxGaWkXh8l1qwCtO/AvzYedz+TuhwOAJ7dP3Vxg6Pd2HHJfF714L+xgJwe/aXTJiTKPI9d3VTrbLfc3JDd2neI1gGUZrqTd//lVtJhV0PN1kebjhwqx8NJvM5vFt2n1frV0B3ZjW3lCJ36LGRUpFpNPgil1RMw+74PcYlAl50KD0Hcz272anFMW5yCyV6Ipz60QjX5L1Gu+lQOxbLRmop5l4ICKVczSNRe0G00bXxdkYPLVNi32CFZLExiT7n/RBuwA1zoiPCTaTCNmMm/X54Hsb/RmtKGkCls6zfM2rV35YW86VY3tVsGjsyJR82rhesLUkNUf9kf7I+rhtWGmeeb8DQomhxqZWsueTBrmL4Y9/9L14FcPgYr/iXd/VKr7SRT+BfsCRWChAP5CSyMVqnHfc3S8q5cv47gVibLzv+3eNb3/pfNygCQ9rlxjm2MBtnW106Tmxoo2Z/n153HHPfW7aLZdilpnYoHMlNSkWJ/Oxw9rGR5UruRt76bNxV5hvh7RjCCJZqaRy4P0iWSr3BRKwdrIcE53hCqeY4hCSN424zSKMezfnXIgAkAsoQmpnmS/+3HwcMsdvRJB2auHzR4fj3wmABLuEdJu71dylB2sij3JtAmAaI6/Js/DieLV038yMPbcQ8+8H9gDEG7VBnrPFtIw9cPbMcvppabDMcedRsJFZpzhFvt8EJ0drlsVQHPjTDZJzNNZB305J5/rdn5wzgC92hmphKIF42SNCvOdkGJQcUC6uLVyy43jW+QRiyJYubYQEl6O1auXA/N/rd5pTpEfUeKcRiQoUXaA7SAHQRMxOF+ehpK0isCHxFMsmkgJneaNXi+sa7yG3bMeUkQTu0idSTDwNNW6BEPvwapJlCPwXds0qmigif1vHsb8CD+1HQ00JC56MfgNrYjCIrH5x1exADvaJtkqms2eoOzqVgP03Y5UoXKmLb7AVCkchoE");